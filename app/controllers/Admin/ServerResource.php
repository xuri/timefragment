<?php

class Admin_ServerResource extends BaseResource
{
    /**
     * 资源视图目录
     * @var string
     */
    protected $resourceView = 'admin.server';

    /**
     * 资源模型名称，初始化后转为模型实例
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'User';

    /**
     * 资源标识
     * @var string
     */
    protected $resource = 'server';

    /**
     * 资源名称（中文）
     * @var string
     */
    protected $resourceName = '服务器';

    /**
     * 资源列表页面
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        return View::make($this->resourceView.'.index')->with('stime');
    }

}