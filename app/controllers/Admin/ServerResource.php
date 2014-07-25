<?php

class Admin_ServerResource extends BaseResource
{
    /**
     * Resource view directory
     * @var string
     */
    protected $resourceView = 'admin.server';

    /**
     * Model name of the resource, after initialization to a model instance
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'User';

    /**
     * Resource identification
     * @var string
     */
    protected $resource = 'server';

    /**
     * Resource name (Chinese)
     * @var string
     */
    protected $resourceName = '服务器';

    /**
     * Resource list view
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        return View::make($this->resourceView.'.index')->with('stime');
    }

}