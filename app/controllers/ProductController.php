<?php

class ProductController extends BaseResource
{
	/**
	 * Resource view directory
	 * @var string
	 */
	protected $resourceView = 'account.product';

	/**
	 * Model name of the resource, after initialization to a model instance
	 * @var string|Illuminate\Database\Eloquent\Model
	 */
	protected $model = 'Product';

	/**
	 * Resource identification
	 * @var string
	 */
	protected $resource = 'myproduct';

	/**
	 * Resource database tables
	 * @var string
	 */
	protected $resourceTable = 'products';

	/**
	 * Resource name (Chinese)
	 * @var string
	 */
	protected $resourceName = '商品';

	/**
	 * Custom validation message
	 * @var array
	 */
	protected $validatorMessages = array(
		'title.required'        => '请填写商品名称',
		'price.required'        => '请填写商品单价',
		'price.numeric'         => '商品单价只能是数字',
		'quantity.required'     => '请填写商品剩余数量',
		'quantity.integer'      => '商品数量必须是整数',
		'province.required'     => '请选择省份和城市',
		'content.required'      => '请填写商品内容',
		'category.exists'       => '请填选择正确的商品分类',
	);


	protected $destinationPath = 'uploads/products/';
	protected $thumbnailsPath  = 'uploads/product_thumbnails/';

	/**
	 * Resource list view
	 * GET         /resource
	 * @return Response
	 */
	public function index()
	{
		// Get sort conditions
		$orderColumn = Input::get('sort_up', Input::get('sort_down', 'created_at'));
		$direction   = Input::get('sort_up') ? 'asc' : 'desc' ;
		// Get search conditions
		switch (Input::get('target')) {
			case 'title':
			$title = Input::get('like');
			break;
		}
	  // Construct query statement
	  $query = $this->model->orderBy($orderColumn, $direction);
	  isset($title) AND $query->where('title', 'like', "%{$title}%");
	  $datas = $query->where('user_id', Auth::user()->id)->where('post_status', 'open')->paginate(15);
	  return View::make($this->resourceView.'.index')->with(compact('datas'));
	}

	/**
	 * Resource create
	 * Redirect         {id}/new-post
	 * @return Response
	 */
	public function create()
	{
		if( Auth::user()->alipay == NULL ){
			return Redirect::route('account.settings')
				->with('info', '提示：您需要设定支付宝收款账户才可以发布商品出售信息');
		} else {
			$exist = $this->model->where('user_id', Auth::user()->id)->where('post_status', 'close')->first();
			if($exist)
			{
				return Redirect::route($this->resource.'.newPost', $exist->id);
			} else {
				$model                   = $this->model;
				$model->user_id          = Auth::user()->id;
				$model->category_id      = '';
				$model->title            = '';
				$model->slug             = '';
				$model->quantity         = '';
				$model->province         = '';
				$model->city             = '';
				$model->content          = '';
				$model->price            = '';
				$model->meta_title       = '';
				$model->meta_description = '';
				$model->meta_keywords    = '';
				$model->save();
				return Redirect::route($this->resource.'.newPost', $model->id);
			}
		}
	}

	/**
	 * Resource create view
	 * GET         /resource/create
	 * @return Response
	 */
	public function newPost($id)
	{
		$data          = $this->model->find($id);
		$categoryLists = ProductCategories::lists('name', 'id');
		$product       = $this->model->where('id', $id)->first();
		return View::make($this->resourceView.'.create')->with(compact('data', 'categoryLists', 'product'));
	}

	/**
	 * Resource create action
	 * POST        /resource
	 * @return Response
	 */
	public function store($id)
	{
		// Get all form data.
		$data    = Input::all();
		// Create validation rules
		$unique  = $this->unique();
		$rules   = array(
			'title'        => 'required|'.$unique,
			'price'        => 'required|numeric',
			'quantity'     => 'required|integer',
			'content'      => 'required',
			'category'     => 'exists:product_categories,id',
			'province'     => 'required',
		);
		$slug      = Input::input('title');
		$hashslug  = date('H.i.s').'-'.md5($slug).'.html';
		// Custom validation message
		$messages  = $this->validatorMessages;
		// Begin verification
		$validator = Validator::make($data, $rules, $messages);
		if ($validator->passes()) {
			// Verification success
			// Add recource
			$model                   = $this->model->find($id);
			$model->category_id      = $data['category'];
			$model->title            = e($data['title']);
			$model->province         = e($data['province']);
			$model->city             = e($data['city']);
			$model->price            = e($data['price']);
			$model->quantity         = e($data['quantity']);
			$model->slug             = $hashslug;
			$model->content          = e($data['content']);
			$model->meta_title       = e($data['title']);
			$model->meta_description = e($data['title']);
			$model->meta_keywords    = e($data['title']);
			$model->post_status      = 'open';

			$timeline                = new Timeline;
			$timeline->slug          = $hashslug;
			$timeline->model         = 'Product';
			$timeline->user_id       = Auth::user()->id;
			if ($model->save() && $timeline->save()) {
				// Add success
				return Redirect::route($this->resource.'.edit', $model->id)
					->with('success', '<strong>'.$this->resourceName.'添加成功：</strong>您可以继续编辑'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
			} else {
				// Add fail
				return Redirect::back()
					->withInput()
					->with('error', '<strong>'.$this->resourceName.'添加失败。</strong>');
			}
		} else {
			// Verification fail
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}

	/**
	 * Resource edit view
	 * GET         /resource/{id}/edit
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data          = $this->model->find($id);
		$categoryLists = ProductCategories::lists('name', 'id');
		$product       = $this->model->where('slug', $data->slug)->first();
		return View::make($this->resourceView.'.edit')->with(compact('data', 'categoryLists', 'product'));
	}

	/**
	 * Resource edit action
	 * PUT/PATCH   /resource/{id}
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// Get all form data.
		$data = Input::all();
		// Create validation rules
		$rules  = array(
			'title'        => 'required',
			'content'      => 'required',
			'price'        => 'required|numeric',
			'quantity'     => 'required|integer',
			'category'     => 'exists:product_categories,id',
			'province'     => 'required',
		);
		// Custom validation message
		$messages  = $this->validatorMessages;
		// Begin verification
		$validator = Validator::make($data, $rules, $messages);
		if ($validator->passes()) {

			// Verification success
			// Update resource
			$model                   = $this->model->find($id);
			$model->user_id          = Auth::user()->id;
			$model->category_id      = $data['category'];
			$model->title            = e($data['title']);
			$model->province         = e($data['province']);
			$model->city             = e($data['city']);
			$model->price            = e($data['price']);
			$model->quantity         = e($data['quantity']);
			$model->content          = e($data['content']);
			$model->meta_title       = e($data['title']);
			$model->meta_description = e($data['title']);
			$model->meta_keywords    = e($data['title']);

			if ($model->save()) {
				// Update success
				return Redirect::back()
					->with('success', '<strong>'.$this->resourceName.'更新成功：</strong>您可以继续编辑'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
			} else {
				// Update fail
				return Redirect::back()
					->withInput()
					->with('error', '<strong>'.$this->resourceName.'更新失败。</strong>');
			}
		} else {
			// Verification fail
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}

	/**
	 * Resource destory action
	 * DELETE      /resource/{id}
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$data = $this->model->find($id);
		if (is_null($data))
			return Redirect::back()->with('error', '没有找到对应的'.$this->resourceName.'。');
		elseif ($data)
		{
			$trading = ProductOrder::where('product_id', $id)->where('is_payment', true)->where('is_checkout', false)->first();
			if($trading)
			{
				return Redirect::back()->with('warning', $this->resourceName.'正在交易中，暂时不能删除。');
			} else {
				$model      = $this->model->find($id);
				$thumbnails = $model->thumbnails;
				if($thumbnails != NULL){
					destoryUploadImages($this->thumbnailsPath, $thumbnails);
					$images = ProductPictures::where('product_id', $id)->get();
					foreach ($images as $singleImage) {
						destoryUploadImages($this->destinationPath, $singleImage->filename);
					}
				}
				$timeline = Timeline::where('slug', $model->slug)->where('user_id', Auth::user()->id)->first();
				$timeline->delete();

				$data->delete();

				return Redirect::back()->with('success', $this->resourceName.'删除成功。');
			}
		}
		else
			return Redirect::back()->with('warning', $this->resourceName.'删除失败。');
	}

	/**
	 * Action: Add resource images
	 * @return Response
	 */
	public function postUpload($id)
	{
		$input = Input::all();
		$rules = array(
			'file' => 'image|max:3000',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails())
		{
			return Response::make($validation->errors->first(), 400);
		}
		$file                = Input::file('file');
		$normal_name		 = uploadImagesProcess($file, $this->destinationPath, 848, 556, 1696, 1132, $this->thumbnailsPath, 360, 214, 720, 428);

		$model               = $this->model->find($id);
		$oldThumbnails       = $model->thumbnails;
		if($oldThumbnails != NULL){
			destoryUploadImages($this->thumbnailsPath, $oldThumbnails);
		}
		$model->thumbnails   = $normal_name;

		$models              = new ProductPictures;
		$models->filename    = $normal_name;
		$models->product_id  = $id;
		$models->user_id     = Auth::user()->id;

		if($model->save() && $models->save()) {
			return Response::json('success', 200);
		} else {
			return Response::json('error', 400);
		}
	}

	/**
	 * Action: Delete resource images
	 * @return Response
	 */
	public function deleteUpload($id)
	{
		// Only allows you to share pictures on the cover of the current resource being deleted
		$filename = ProductPictures::where('id', $id)->where('user_id', Auth::user()->id)->first();
		$oldImage = $filename->filename;
		$model               = $this->model->find($filename->product_id);
		$oldThumbnails       = $model->thumbnails;
		if (is_null($filename)) {
			return Redirect::back()->with('error', '没有找到对应的图片');
		} elseif ($filename->delete()) {
			destoryUploadImages($this->destinationPath, $oldImage);
			if($oldImage == $oldThumbnails) {
				$model->thumbnails = NULL;
				$model->save();
				destoryUploadImages($this->thumbnailsPath, $oldThumbnails);
			}
			return Redirect::back()->with('success', '图片删除成功。');
		} else {
			return Redirect::back()->with('warning', '图片删除失败。');
		}
	}

	/**
	 * View: My comments
	 * @return Response
	 */
	public function comments()
	{
		$comments = ProductComment::where('user_id', Auth::user()->id)->paginate(15);
		return View::make($this->resourceView.'.comments')->with(compact('comments'));
	}

	/**
	 * Action: Delete my comments
	 * @return Response
	 */
	public function deleteComment($id)
	{
		// Delete operations only allow comments to yourself
		$comment = ProductComment::where('id', $id)->where('user_id', Auth::user()->id)->first();
		if (is_null($comment))
			return Redirect::back()->with('error', '没有找到对应的评论');
		elseif ($comment->delete())
			return Redirect::back()->with('success', '评论删除成功。');
		else
			return Redirect::back()->with('warning', '评论删除失败。');
	}

	/**
	 * View: Product
	 * @return Respanse
	 */
	public function getIndex()
	{
		$product    = $this->model->where('post_status', 'open')->orderBy('created_at', 'desc')->where('quantity', '>', '0')->paginate(12);
		$categories = ProductCategories::where('cat_status', 'open')->orderBy('sort_order')->paginate(6);
		return View::make('product.index')->with(compact('product', 'categories', 'data'));
	}

	/**
	 * Resource list
	 * @return Respanse
	 */
	public function category($category_id)
	{
		$product          = $this->model->where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(6);
		$categories       = ProductCategories::orderBy('sort_order')->get();
		$current_category = ProductCategories::where('id', $category_id)->first();
		return View::make('product.category')->with(compact('product', 'categories', 'category_id', 'current_category'));
	}

	/**
	 * Resource show view
	 * @param  string $slug Slug
	 * @return response
	 */
	public function show($slug)
	{
		$product    = $this->model->where('slug', $slug)->first();
		is_null($product) AND App::abort(404);
		$categories = ProductCategories::orderBy('sort_order')->get();
		if (Auth::check())
		{
			$inCart = ShoppingCart::where('buyer_id', Auth::user()->id)->where('product_id', $product->id)->first();
		} else {
			$inCart = false;
		}
		return View::make('product.show')->with(compact('product', 'categories', 'inCart'));

	}

	/**
	* View: Customer shopping cart
	* @return Response
	*/
	public function cart()
	{
		// Get sort conditions
		$orderColumn = Input::get('sort_up', Input::get('sort_down', 'created_at'));
		$direction   = Input::get('sort_up') ? 'asc' : 'desc' ;
		// Get search conditions
		switch (Input::get('target')) {
			case 'title':
				$title = Input::get('like');
				break;
		}
		// Construct query statement
		$query 		  = ShoppingCart::orderBy($orderColumn, $direction)->where('buyer_id', Auth::user()->id)->paginate(15);
		isset($title) AND $query->where('title', 'like', "%{$title}%");
		$datas        = $query;
		$payment      = ShoppingCart::where('buyer_id', Auth::user()->id)->sum('payment');

		$resource     = 'myproduct';
		$resourceName = '购物车';
		return View::make($this->resourceView.'.cart')->with(compact('datas', 'resource', 'resourceName', 'payment'));
	}

	/**
	 * Action: Delete goods in customer shopping cart
	 * @return Response
	 */
	public function destroyGoods($id)
	{
		$data = ShoppingCart::find($id);
		if (is_null($data))
			return Redirect::back()->with('error', '没有找到对应的'.$this->resourceName.'。');
		elseif ($data)
		{
			$data->delete();

			return Redirect::back()->with('success', $this->resourceName.'删除成功。');
		}
		else
			return Redirect::back()->with('warning', $this->resourceName.'删除失败。');
	}

	/**
	* Action: Show page post action
	* @return Response
	*/
	public function postAction($slug)
	{
		$postComment = e(Input::get('postComment'));
		if($postComment)
		{
			// Get comment
			$content = e(Input::get('content'));
			// Check word
			if (mb_strlen($content) < 3)
				return Redirect::back()->withInput()->withErrors($this->messages->add('content', '评论不得少于3个字符。'));
			// Find article
			$product             = $this->model->where('slug', $slug)->first();
			// Create comment
			$comment             = new ProductComment;
			$comment->content    = $content;
			$comment->product_id = $product->id;
			$comment->user_id    = Auth::user()->id;
			if ($comment->save()) {
				// Create success
				// Updated comments
				$product->comments_count = $product->comments->count();
				$product->save();
				// Return success
				return Redirect::back()->with('success', '评论成功。');
			} else {
				// Create fail
				return Redirect::back()->withInput()->with('error', '评论失败。');
			}
		} else {

			$data  = Input::all();
			$rules = array(
				'quantity'     => 'required|integer',
				'product_id'   => 'required',
				'price'        => 'required',
				'seller_id'    => 'required',
				'inventory'    => 'required',
			);

			if (e($data['inventory']) < e($data['quantity'])) {
				return Redirect::back()
			  ->with('error', '<strong>请输入正确的'.$this->resourceName.'购买数量</strong>');
			} elseif (Auth::user()->id == e($data['seller_id'])) {
				return Redirect::back()
			  ->with('error', '<strong>您不能购买自己出售的商品</strong>');
			} else {

			// Custom validation message
			$messages  = $this->validatorMessages;
			// Begin verification
			$validator = Validator::make($data, $rules, $messages);

			if ($validator->passes()) {
			// Verification success
			// Add recource
			$model                   = new ShoppingCart;
			$model->buyer_id         = Auth::user()->id;
			$model->quantity         = e($data['quantity']);
			$model->product_id       = e($data['product_id']);
			$model->price            = e($data['price']);
			$model->payment          = e($data['quantity']) * e($data['price']);
			$model->seller_id        = e($data['seller_id']);

				if ($model->save()) {
					// Add success
					return Redirect::back()
					  ->with('success', '<strong>'.$this->resourceName.'已添加到购物车：</strong>您可以继续选购'.$this->resourceName.'，或立即结算。');
					} else {
					  // Add fail
					  return Redirect::back()
						  ->withInput()
						  ->with('error', '<strong>'.$this->resourceName.'添加到购物车失败。</strong>');
					}
				} else {
					// Verification fail
					return Redirect::back()->withInput()->withErrors($validator);
				}
			}
		}
	}

}