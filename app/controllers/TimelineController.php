<?php

/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @uses        Laravel The PHP frameworks for web artisans http://laravel.com
 * @author      Ri Xu http://xuri.me
 * @copyright   Copyright (c) TimeFragment
 * @link        http://www.timefragment.com
 * @since       25th Nov, 2014
 * @license     Licensed under The MIT License http://www.opensource.org/licenses/mit-license.php
 * @version     0.1
 */

class TimelineController extends BaseResource
{

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
        $timeline = $this->model->orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(8);
        return View::make('timeline.index')->with(compact('timeline'));
    }


    /**
     * View: User timeline
     * @return Respanse
     */
    public function getTimeline($id)
    {
        $timeline = $this->model->where('user_id', $id)->paginate(8);
        $user     = User::where('id', $id)->first();
        return View::make('timeline.timeline')->with(compact('timeline', 'user'));
    }
}