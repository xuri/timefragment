<?php

class TimelineController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Timeline Controller
    |--------------------------------------------------------------------------
    |
    */

    /**
     * 资源视图目录
     * @var string
     */
    protected $resourceView = 'timeline';

    /**
     * 资源模型名称，初始化后转为模型实例
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'Timeline';

    /**
     * 资源标识
     * @var string
     */
    protected $resource = 'timeline';

    /**
     * 资源名称（中文）
     * @var string
     */
    protected $resourceName = '时间线';

    /**
     * 页面：时间线
     * @return Respanse
     */
    public function getIndex()
    {
        $timeline = Timeline::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
        return View::make('timeline.index')->with(compact('timeline'));
    }

}