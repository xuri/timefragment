<?php

class Admin_ArticleResource extends BaseResource
{
	/**
	 * Resource view directory
	 * @var string
	 */
	protected $resourceView = 'admin.article';

	/**
	 * Model name of the resource, after initialization to a model instance
	 * @var string|Illuminate\Database\Eloquent\Model
	 */
	protected $model = 'Article';

	/**
	 * Resource identification
	 * @var string
	 */
	protected $resource = 'myarticles';

	/**
	 * Resource database tables
	 * @var string
	 */
	protected $resourceTable = 'articles';

	/**
	 * Resource name (Chinese)
	 * @var string
	 */
	protected $resourceName = '文章';

	/**
	 * Custom validation message
	 * @var array
	 */
	protected $validatorMessages = array(
		'title.required'		=> '请填写文章标题。',
		'title.unique'			=> '已有同名文章。',
		'slug.required'			=> '请填写文章 sulg。',
		'slug.unique'			=> '已有同名 sulg。',
		'article_icon.required'	=> '请设置首页图标。',
		'content.required'		=> '请填写文章内容。',
		'excerpt.required'		=> '请填写文章摘要。',
		'category.exists'		=> '请填选择正确的文章分类。',
	);

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
		$datas = $query->where('post_status', 'open')->paginate(15);
		return View::make($this->resourceView.'.index')->with(compact('datas'));
	}

	/**
	 * Resource create
	 * Redirect         {id}/new-post
	 * @return Response
	 */
	public function create()
	{
		$exist = $this->model->where('user_id', Auth::user()->id)->where('post_status', 'close')->first();
		if($exist)
		{
			return Redirect::route($this->resource.'.newPost', $exist->id);
		} else {
			$model						= $this->model;
			$model->user_id				= Auth::user()->id;
			$model->category_id			= '';
			$model->title				= '';
			$model->slug				= '';
			$model->article_icon		= '';
			$model->content				= '';
			$model->excerpt				= '';
			$model->meta_title			= '';
			$model->meta_description	= '';
			$model->meta_keywords		= '';
			$model->save();
			return Redirect::route($this->resource.'.newPost', $model->id);
		}
	}

	/**
	 * Resource create view
	 * GET         /resource/create
	 * @return Response
	 */
	public function newPost($id)
	{
		$data			= $this->model->find($id);
		$categoryLists	= Category::lists('name', 'id');
		$article		= $this->model->where('id', $id)->first();
		return View::make($this->resourceView.'.create')->with(compact('data', 'categoryLists', 'article'));
	}

	/**
	 * Resource create action
	 * POST        /resource
	 * @return Response
	 */
	public function store($id)
	{
		// Get all form data.
		$data	= Input::all();
		// Create validation rules
		$unique	= $this->unique();
		$rules  = array(
			'title'		=> 'required|'.$unique,
			'slug'		=> 'required|'.$unique,
			'content'	=> 'required',
			'excerpt'	=> 'required',
			'category'	=> 'exists:article_categories,id',
		);
		// Custom validation message
		$messages	= $this->validatorMessages;
		// Begin verification
		$validator	= Validator::make($data, $rules, $messages);
		if ($validator->passes()) {
			// Verification success
			// Add resource
			$model						= $this->model->find($id);
			$model->category_id			= $data['category'];
			$model->title				= e($data['title']);
			$model->slug				= e($data['slug']);
			$model->article_icon		= e($data['article_icon']);
			$model->content				= e($data['content']);
			$model->excerpt				= e($data['excerpt']);
			$model->meta_title			= e($data['meta_title']);
			$model->meta_description	= e($data['meta_description']);
			$model->meta_keywords		= e($data['meta_keywords']);
			$model->post_status			= 'open';
			if ($model->save()) {
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
		$data			= $this->model->find($id);
		$categoryLists	= Category::lists('name', 'id');
		$article		= Article::where('slug', $data->slug)->first();
		return View::make($this->resourceView.'.edit')->with(compact('data', 'categoryLists', 'article'));
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
		$data	= Input::all();
		// Create validation rules
		$rules	= array(
			'title'		=> 'required|'.$this->unique('title', $id),
			'slug'		=> 'required|'.$this->unique('slug', $id),
			'content'	=> 'required',
			'excerpt'	=> 'required',
			'category'	=> 'exists:article_categories,id',
		);
		// Custom validation message
		$messages	= $this->validatorMessages;
		// Begin verification
		$validator	= Validator::make($data, $rules, $messages);
		if ($validator->passes()) {

			// Verification success
			// Update source
			$model						= $this->model->find($id);
			$model->category_id			= $data['category'];
			$model->title				= e($data['title']);
			$model->slug				= e($data['slug']);
			$model->article_icon		= e($data['article_icon']);
			$model->content				= e($data['content']);
			$model->excerpt				= e($data['excerpt']);
			$model->meta_title			= e($data['meta_title']);
			$model->meta_description	= e($data['meta_description']);
			$model->meta_keywords		= e($data['meta_keywords']);

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

		$file				= Input::file('file');
		$destinationPath	= 'uploads/articles/';
		$ext				= $file->guessClientExtension();  // Get real extension according to mime type
		$fullname			= $file->getClientOriginalName(); // Client file name, including the extension of the client
		$hashname			= date('H.i.s').'-'.md5($fullname).'.'.$ext; // Hash processed file name, including the real extension
		$picture			= Image::make($file->getRealPath());
		// crop the best fitting ratio and resize image
		$picture->fit(1024, 683)->save(public_path($destinationPath.$hashname));
		$models				= new Picture;
		$models->filename	= $hashname;
		$models->article_id	= $id;
		$models->user_id	= Auth::user()->id;

		if($models->save()) {
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
		// Allow only pictures of the current article being deleted
		$filename	= Picture::where('id', $id)->where('user_id', Auth::user()->id)->first();
		$oldImage	= $filename->filename;

		if (is_null($filename))
			return Redirect::back()->with('error', '没有找到对应的图片');
		elseif ($filename->delete()) {

		// Delete images
		File::delete(
			public_path('uploads/articles/'.$oldImage)
		);
			return Redirect::back()->with('success', '图片删除成功。');
		}

		else
			return Redirect::back()->with('warning', '图片删除失败。');
	}
}
