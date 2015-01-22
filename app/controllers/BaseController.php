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

class BaseController extends Controller
{

	/**
	 * Message objects
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messages = null;

	/**
	 * Initialize
	 * @return void
	 */
	public function __construct()
	{
		// CSRF protection
		$this->beforeFilter('csrf', array('on' => 'post|put|delete', 'except' => 'tradeNotify'));
		// Instantiate a messaging object
		$this->messages = new Illuminate\Support\MessageBag;
	}

	/**
	 * When is responsible for the response of the method does not return a value, or when the return value is null,
	 * System will determine whether the layout attribute is empty,
	 * If it is not null, then according to the layout property, returns a view responses.
	 * @return void
	 */
	protected function setupLayout()
	{
		if (! is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}

}