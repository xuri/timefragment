<?php

class Admin_ArticleResource extends BaseResource
{
    /**
     * 资源视图目录
     * @var string
     */
    protected $resourceView = 'admin.article';

    /**
     * 资源模型名称，初始化后转为模型实例
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'Article';

    /**
     * 资源标识
     * @var string
     */
    protected $resource = 'myarticles';

    /**
     * 资源数据库表
     * @var string
     */
    protected $resourceTable = 'articles';

    /**
     * 资源名称（中文）
     * @var string
     */
    protected $resourceName = '文章';

    /**
     * 自定义验证消息
     * @var array
     */
    protected $validatorMessages = array(
        'title.required'        => '请填写文章标题。',
        'title.unique'          => '已有同名文章。',
        'slug.required'         => '请填写文章 sulg。',
        'slug.unique'           => '已有同名 sulg。',
        'article_icon.required' => '请设置首页图标。',
        'content.required'      => '请填写文章内容。',
        'excerpt.required'      => '请填写文章摘要。',
        'category.exists'       => '请填选择正确的文章分类。',
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
        $query = $this->model->orderBy($orderColumn, $direction);
        isset($title) AND $query->where('title', 'like', "%{$title}%");
        $datas = $query->paginate(15);
        return View::make($this->resourceView.'.index')->with(compact('datas'));
    }

    /**
     * 资源创建页面
     * GET         /resource/create
     * @return Response
     */
    public function create()
    {
        $categoryLists = Category::lists('name', 'id');
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
            'slug'         => 'required|'.$unique,
            'content'      => 'required',
            'excerpt'      => 'required',
            'category'     => 'exists:article_categories,id',
        );
        // 自定义验证消息
        $messages = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 添加资源
            $model                   = $this->model;
            $model->user_id          = Auth::user()->id;
            $model->category_id      = $data['category'];
            $model->title            = e($data['title']);
            $model->slug             = e($data['slug']);
            $model->article_icon     = e($data['article_icon']);
            $model->content          = e($data['content']);
            $model->excerpt          = e($data['excerpt']);
            $model->meta_title       = e($data['meta_title']);
            $model->meta_description = e($data['meta_description']);
            $model->meta_keywords    = e($data['meta_keywords']);
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
        $data          = $this->model->find($id);
        $categoryLists = Category::lists('name', 'id');
        $article       = Article::where('slug', $data->slug)->first();
        return View::make($this->resourceView.'.edit')->with(compact('data', 'categoryLists', 'article'));
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
        $rules = array(
            'title'        => 'required|'.$this->unique('title', $id),
            'slug'         => 'required|'.$this->unique('slug', $id),
            'content'      => 'required',
            'excerpt'      => 'required',
            'category'     => 'exists:article_categories,id',
        );
        // 自定义验证消息
        $messages  = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {

            // 验证成功
            // 更新资源
            $model = $this->model->find($id);
            $model->category_id      = $data['category'];
            $model->title            = e($data['title']);
            $model->slug             = e($data['slug']);
            $model->article_icon     = e($data['article_icon']);
            $model->content          = e($data['content']);
            $model->excerpt          = e($data['excerpt']);
            $model->meta_title       = e($data['meta_title']);
            $model->meta_description = e($data['meta_description']);
            $model->meta_keywords    = e($data['meta_keywords']);

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

    public function postUpload($id){

        $input = Input::all();
        $rules = array(
            'file' => 'image|max:3000',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors->first(), 400);
        }

        $file               = Input::file('file');
        $destinationPath    = 'uploads/articles/';
        $ext                = $file->guessClientExtension();  // Get real extension according to mime type
        $fullname           = $file->getClientOriginalName(); // Client file name, including the extension of the client
        $hashname           = date('H.i.s').'-'.md5($fullname).'.'.$ext; // Hash processed file name, including the real extension
        Input::file('file')->move($destinationPath, $hashname);
        $models             = new Picture;
        $models->filename   = $hashname;
        $models->article_id = $id;
        $models->user_id    = Auth::user()->id;
        $models->save();

        if($models->save()) {
           return Response::json('success', 200);
        } else {
           return Response::json('error', 400);
        }
    }

    /**
     * 动作：删除文章图片
     * @return Response
     */
    public function deleteArticlePicture($id)
    {
        // 仅允许对当前文章的图片进行删除操作
        $filename = Picture::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $oldImage = $filename->filename;

        if (is_null($filename))
            return Redirect::back()->with('error', '没有找到对应的图片');
        elseif ($filename->delete()) {

        // 删除图片
        File::delete(
            public_path('uploads/articles/'.$oldImage)
        );
            return Redirect::back()->with('success', '图片删除成功。');
        }

        else
            return Redirect::back()->with('warning', '图片删除失败。');
    }
}
