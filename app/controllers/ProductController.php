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
        'title.required'        => '请填写商品名称。',
        'title.unique'          => '已有同名商品呢。',
        'slug.unique'           => '已有同名 sulg。',
        'province.required'     => '请选择省份和城市',
        'content.required'      => '请填写商品呢内容。',
        'category.exists'       => '请填选择正确的商品呢分类。',
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
        $query = $this->model->orderBy($orderColumn, $direction)->where('user_id', Auth::user()->id)->paginate(15);
        isset($title) AND $query->where('title', 'like', "%{$title}%");
        $datas = $query;
        return View::make($this->resourceView.'.index')->with(compact('datas'));
    }

    /**
     * Resource create view
     * GET         /resource/create
     * @return Response
     */
    public function create()
    {
        $categoryLists = ProductCategories::lists('name', 'id');
        return View::make($this->resourceView.'.create')->with(compact('categoryLists'));
    }

    /**
     * Resource create action
     * POST        /resource
     * @return Response
     */
    public function store()
    {
        // Get all form data.
        $data   = Input::all();
        // Create validation rules
        $unique = $this->unique();
        $rules  = array(
            'title'        => 'required|'.$unique,
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
            $model                   = $this->model;
            $model->user_id          = Auth::user()->id;
            $model->category_id      = $data['category'];
            $model->title            = e($data['title']);
            $model->province         = e($data['province']);
            $model->city             = e($data['city']);
            $model->slug             = $hashslug;
            $model->content          = e($data['content']);
            $model->meta_title       = e($data['title']);
            $model->meta_description = e($data['title']);
            $model->meta_keywords    = e($data['title']);
            $model->save();

            $timeline                = new Timeline;
            $timeline->slug          = $hashslug;
            $timeline->model         = 'Product';
            $timeline->user_id       = Auth::user()->id;
            if ($timeline->save()) {
                // Add success
                return Redirect::back()
                    ->with('success', '<strong>'.$this->resourceName.'添加成功：</strong>您可以继续添加新'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
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
        $product       = Product::where('slug', $data->slug)->first();
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
            'category'     => 'exists:product_categories,id',
            'province'     => 'required',
        );
        // Custom validation message
        $messages = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {

            // Verification success
            // Update resource
            $model = $this->model->find($id);
            $model->user_id          = Auth::user()->id;
            $model->category_id      = $data['category'];
            $model->title            = e($data['title']);
            $model->province         = e($data['province']);
            $model->city             = e($data['city']);
            $model->content          = e($data['content']);
            $model->meta_title       = e($data['title']);
            $model->meta_description = e($data['title']);
            $model->meta_keywords    = e($data['title']);

            if ($model->save()) {
                // Update success
                return Redirect::back()
                    ->with('success', '<strong>'.$this->resourceName.'Update success：</strong>您可以继续编辑'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
            } else {
                // Update fail
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>'.$this->resourceName.'Update fail。</strong>');
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
            $model      = $this->model->find($id);
            $thumbnails = $model->thumbnails;
            File::delete(public_path('uploads/product_thumbnails/'.$thumbnails));

            $timeline = Timeline::where('slug', $model->slug)->where('user_id', Auth::user()->id)->first();
            $timeline->delete();

            $data->delete();

            return Redirect::back()->with('success', $this->resourceName.'删除成功。');
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
        $destinationPath     = 'uploads/products/';
        $ext                 = $file->guessClientExtension();  // Get real extension according to mime type
        $fullname            = $file->getClientOriginalName(); // Client file name, including the extension of the client
        $hashname            = date('H.i.s').'-'.md5($fullname).'.'.$ext; // Hash processed file name, including the real extension
        $picture             = Image::make($file->getRealPath());
        // crop the best fitting ratio and resize image
        $picture->fit(1024, 683)->save(public_path($destinationPath.$hashname));
        $picture->fit(585, 347)->save(public_path('uploads/product_thumbnails/'.$hashname));

        $model               = $this->model->find($id);
        $oldThumbnails       = $model->thumbnails;
        $model->thumbnails   = $hashname;
        $model->save();

        File::delete(public_path('uploads/product_thumbnails/'.$oldThumbnails));

        $models              = new ProductPictures;
        $models->filename    = $hashname;
        $models->product_id  = $id;
        $models->user_id     = Auth::user()->id;
        $models->save();

        if( $models->save() ) {
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

        if (is_null($filename))
            return Redirect::back()->with('error', '没有找到对应的图片');
        elseif ($filename->delete()) {

        File::delete(
            public_path('uploads/products/'.$oldImage)
        );
            return Redirect::back()->with('success', '图片删除成功。');
        }

        else
            return Redirect::back()->with('warning', '图片删除失败。');
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
        $product    = Product::orderBy('created_at', 'desc')->paginate(12);
        $categories = ProductCategories::orderBy('sort_order')->paginate(6);
        return View::make('product.index')->with(compact('product', 'categories', 'data'));
    }

    /**
     * Resource list
     * @return Respanse
     */
    public function category($category_id)
    {
        $product          = Product::where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(6);
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
        $product    = Product::where('slug', $slug)->first();
        is_null($product) AND App::abort(404);
        $categories = ProductCategories::orderBy('sort_order')->get();
        return View::make('product.show')->with(compact('product', 'categories'));
    }

    public function postComment($slug)
    {
        // Get comment
        $content = e(Input::get('content'));
        // Check word
        if (mb_strlen($content)<3)
            return Redirect::back()->withInput()->withErrors($this->messages->add('content', '评论不得少于3个字符。'));
        // Find article
        $product     = Product::where('slug', $slug)->first();
        // Create comment
        $comment = new ProductComment;
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
    }

}
