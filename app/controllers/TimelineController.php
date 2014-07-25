<?php

class TimelineController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Timeline Controller
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Resource view directory
     * @var string
     */
    protected $resourceView = 'timeline';

    /**
     * Model name of the resource, after initialization to a model instance
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'Timeline';

    /**
     * Resource identification
     * @var string
     */
    protected $resource = 'timeline';

    /**
     * Resource name (Chinese)
     * @var string
     */
    protected $resourceName = '时间线';

    /**
     * View: Timeline
     * @return Respanse
     */
    public function getIndex()
    {
        $timeline = Timeline::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
        return View::make('timeline.index')->with(compact('timeline'));
    }

}