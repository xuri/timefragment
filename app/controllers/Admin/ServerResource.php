<?php

/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @uses        Laravel The PHP frameworks for web artisans http://laravel.com
 * @author      Ri Xu http://xuri.me <xuri.me@gmail.com>
 * @copyright   Copyright (c) TimeFragment
 * @link        http://www.timefragment.com
 * @since       25th Nov, 2014
 * @license     Licensed under The MIT License http://www.opensource.org/licenses/mit-license.php
 * @version     0.1
 */

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