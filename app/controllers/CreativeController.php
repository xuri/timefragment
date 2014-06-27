<?php

class CreativeController extends BaseResource
{
    /**
     * 资源视图目录
     * @var string
     */
    protected $resourceView = 'account.creative';

    /**
     * 资源模型名称，初始化后转为模型实例
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'Creative';

    /**
     * 资源标识
     * @var string
     */
    protected $resource = 'mycreative';

    /**
     * 资源数据库表
     * @var string
     */
    protected $resourceTable = 'creative';

    /**
     * 资源名称（中文）
     * @var string
     */
    protected $resourceName = '创意';

    /**
     * 自定义验证消息
     * @var array
     */
    protected $validatorMessages = array(
        'title.required'        => '请填写创意标题。',
        'title.unique'          => '已有同名创意。',
        'slug.unique'           => '已有同名 sulg。',
        'content.required'      => '请填写创意内容。',
        'category.exists'       => '请填选择正确的创意分类。',
    );

    /**
     * 资源列表页面
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        // 获取排序条件
        $orderColumn = Input::get('sort_up', Input::get('sort_down', 'created_at'));
        $direction   = Input::get('sort_up') ? 'asc' : 'desc' ;
        // 获取搜索条件
        switch (Input::get('target')) {
            case 'title':
                $title = Input::get('like');
                break;
        }
        // 构造查询语句
        $datas = Creative::where('user_id', Auth::user()->id)->paginate(15);
        return View::make($this->resourceView.'.index')->with(compact('datas'));
    }

    /**
     * 资源创建页面
     * GET         /resource/create
     * @return Response
     */
    public function create()
    {
        $categoryLists = CreativeCategories::lists('name', 'id');
        return View::make($this->resourceView.'.create')->with(compact('categoryLists'));
    }

    /**
     * 资源创建动作
     * POST        /resource
     * @return Response
     */
    public function store()
    {
        // 获取所有表单数据.
        $data   = Input::all();
        // 创建验证规则
        $unique = $this->unique();
        $rules  = array(
            'title'        => 'required|'.$unique,
            'content'      => 'required',
            'category'     => 'exists:creative_categories,id',
        );
        $slug      = Input::input('title');
        $hashslug  = date('H.i.s').'-'.md5($slug).'.html';
        // 自定义验证消息
        $messages  = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 添加资源
            $model                   = $this->model;
            $model->user_id          = Auth::user()->id;
            $model->category_id      = $data['category'];
            $model->title            = e($data['title']);
            $model->slug             = $hashslug;
            $model->content          = e($data['content']);
            $model->meta_title       = e($data['title']);
            $model->meta_description = e($data['title']);
            $model->meta_keywords    = e($data['title']);

            if ($model->save()) {
                // 添加成功
                return Redirect::back()
                    ->with('success', '<strong>'.$this->resourceName.'添加成功：</strong>您可以继续添加新'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
            } else {
                // 添加失败
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>'.$this->resourceName.'添加失败。</strong>');
            }
        } else {
            // 验证失败
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * 资源编辑页面
     * GET         /resource/{id}/edit
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->model->find($id);
        $categoryLists = CreativeCategories::lists('name', 'id');
        $creative = Creative::where('slug', $data->slug)->first();
        return View::make($this->resourceView.'.edit')->with(compact('data', 'categoryLists', 'creative'));
    }

    /**
     * 资源编辑动作
     * PUT/PATCH   /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        // 获取所有表单数据.
        $data = Input::all();
        // 创建验证规则
        $rules  = array(
            'title'        => 'required',
            'content'      => 'required',
            'category'     => 'exists:creative_categories,id',
        );
        $slug = Input::input('title');
        $hashslug = date('H.i.s').'-'.md5($slug).'.html';
        // 自定义验证消息
        $messages = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {

            // 验证成功
            // 更新资源
            $model = $this->model->find($id);
            $model->user_id          = Auth::user()->id;
            $model->category_id      = $data['category'];
            $model->title            = e($data['title']);
            $model->slug             = $hashslug;
            $model->content          = e($data['content']);
            $model->meta_title       = e($data['title']);
            $model->meta_description = e($data['title']);
            $model->meta_keywords    = e($data['title']);

            if ($model->save()) {
                // 更新成功
                return Redirect::back()
                    ->with('success', '<strong>'.$this->resourceName.'更新成功：</strong>您可以继续编辑'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
            } else {
                // 更新失败
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>'.$this->resourceName.'更新失败。</strong>');
            }
        } else {
            // 验证失败
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * 动作：添加创意汇图片
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
        $destinationPath     = 'uploads/creative/';
        $ext                 = $file->guessClientExtension();  // Get real extension according to mime type
        $fullname            = $file->getClientOriginalName(); // Client file name, including the extension of the client
        $hashname            = date('H.i.s').'-'.md5($fullname).'.'.$ext; // Hash processed file name, including the real extension
        $picture             = Image::make($file->getRealPath());
        $picture->save(public_path($destinationPath.$hashname));
        $picture->resize(585, 347)->save(public_path('uploads/creative/single/'.$hashname));

        $model               = $this->model->find($id);
        $oldThumbnails       = $model->thumbnails;
        $model->thumbnails   = $hashname;
        $model->save();

        File::delete(public_path('uploads/creative/single/'.$oldThumbnails));

        $models              = new CreativePictures;
        $models->filename    = $hashname;
        $models->creative_id = $id;
        $models->user_id     = Auth::user()->id;
        $models->save();

        if( $models->save() ) {
           return Response::json('success', 200);
        } else {
           return Response::json('error', 400);
        }
    }

    /**
     * 动作：删除创意汇图片
     * @return Response
     */
    public function deleteUpload($id)
    {
        // 仅允许对当前创意分享的封面图片进行删除操作
        $filename = CreativePictures::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $oldImage = $filename->filename;

        if (is_null($filename))
            return Redirect::back()->with('error', '没有找到对应的图片');
        elseif ($filename->delete()) {

        File::delete(
            public_path('uploads/creative/'.$oldImage)
        );
            return Redirect::back()->with('success', '图片删除成功。');
        }

        else
            return Redirect::back()->with('warning', '图片删除失败。');
    }

    /**
     * 页面：创意汇
     * @return Respanse
     */
    public function getIndex()
    {
        $creative   = Creative::orderBy('created_at', 'desc')->paginate(12);
        $categories = CreativeCategories::orderBy('sort_order')->get();
        return View::make('creative.index')->with(compact('creative', 'categories', 'data'));
    }

    /**
     * 分类创意列表
     * @return Respanse
     */
    public function getArticles($category_id)
    {
        $articles   = Creative::where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(5);
        $categories = CreativeCategories::orderBy('sort_order')->get();
        return View::make('home.category')->with(compact('articles', 'categories', 'category_id'));
    }

    /**
     * 创意展示页面
     * @param  string $slug 创意缩略名
     * @return response
     */
    public function show($slug)
    {
        $creative    = Creative::where('slug', $slug)->first();
        is_null($creative) AND App::abort(404);
        $categories = CreativeCategories::orderBy('sort_order')->get();
        return View::make('creative.show')->with(compact('creative', 'categories'));
    }

    public function postComment($slug)
    {
        // 获取评论内容
        $content = e(Input::get('content'));
        // 字数检查
        if (mb_strlen($content)<3)
            return Redirect::back()->withInput()->withErrors($this->messages->add('content', '评论不得少于3个字符。'));
        // 查找对应文章
        $creative = Creative::where('slug', $slug)->first();
        // 创建文章评论
        $comment = new CreativeComment;
        $comment->content    = $content;
        $comment->creative_id = $creative->id;
        $comment->user_id    = Auth::user()->id;
        if ($comment->save()) {
            // 创建成功
            // 更新评论数
            $creative->comments_count = $creative->comments->count();
            $creative->save();
            // 返回成功信息
            return Redirect::back()->with('success', '评论成功。');
        } else {
            // 创建失败
            return Redirect::back()->withInput()->with('error', '评论失败。');
        }
    }
}
