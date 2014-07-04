<?php

class Admin_JobCategoriesResource extends BaseResource
{
    /**
     * 资源视图目录
     * @var string
     */
    protected $resourceView = 'admin.job_categories';

    /**
     * 资源模型名称，初始化后转为模型实例
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'JobCategories';

    /**
     * 资源标识
     * @var string
     */
    protected $resource = 'job_categories';

    /**
     * 资源数据库表
     * @var string
     */
    protected $resourceTable = 'job_categories';

    /**
     * 资源名称（中文）
     * @var string
     */
    protected $resourceName = '酷工作分类';

    /**
     * 自定义验证消息
     * @var array
     */
    protected $validatorMessages = array(
        'name.required'       => '请填写工作分类名称。',
        'name.unique'         => '已有同名分类。',
        'sort_order.required' => '请填写分类排序。',
        'sort_order.integer'  => '请填写一个整数。',
    );

    /**
     * 资源列表页面
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        $datas = $this->model->orderBy('sort_order')->paginate(15);
        return View::make($this->resourceView.'.index')->with(compact('datas'));
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
            'name'       => 'required|'.$unique,
            'sort_order' => 'required|integer',
            'content'    => 'required|',
        );
        // 自定义验证消息
        $messages  = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 添加资源
            $model = $this->model;
            $model->name       = e($data['name']);
            $model->sort_order = e($data['sort_order']);
            $model->content    = e($data['content']);
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
            'name'       => 'required|'.$this->unique('name', $id),
            'sort_order' => 'required|integer',
            'content'    => 'required|',
        );
        // 自定义验证消息
        $messages  = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 更新资源
            $model = $this->model->find($id);
            $model->name       = e($data['name']);
            $model->sort_order = e($data['sort_order']);
            $model->content    = e($data['content']);
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
     * 动作：添加资源图片
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

        $file              = Input::file('file');
        $destinationPath   = 'uploads/job_category_thumbnails/';
        $ext               = $file->guessClientExtension();  // Get real extension according to mime type
        $fullname          = $file->getClientOriginalName(); // Client file name, including the extension of the client
        $hashname          = date('H.i.s').'-'.md5($fullname).'.'.$ext; // Hash processed file name, including the real extension

        $model             = $this->model->find($id);
        $oldThumbnails     = $model->thumbnails;
        $model->thumbnails = $hashname;
        $model->save();

        $thumbnails        = Image::make($file->getRealPath());
        $upload_success    = $thumbnails->fit(105, 105)->save(public_path($destinationPath.$hashname));

        File::delete(public_path('uploads/job_category_thumbnails/'.$oldThumbnails));

        if( $upload_success ) {
           return Response::json('success', 200);
        } else {
           return Response::json('error', 400);
        }
    }

    /**
     * 动作：删除资源图片
     * @return Response
     */
    public function deleteUpload($id)
    {
        // 仅允许对当前资源的封面图片进行删除操作
        $model      = $this->model->find($id);
        $thumbnails = $model->thumbnails;

        if (is_null($thumbnails))
            return Redirect::back()->with('error', '没有找到对应的图片');
        elseif ($thumbnails) {
        File::delete(public_path('uploads/job_category_thumbnails/'.$thumbnails));
        $model->thumbnails = NULL;
        $model->save();
            return Redirect::back()->with('success', '图片删除成功。');
        }
        else
            return Redirect::back()->with('warning', '图片删除失败。');
    }
}
