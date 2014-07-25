<?php

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
		$this->beforeFilter('csrf', array('on' => 'post|put|delete'));
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