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

class BaseResource extends BaseController
{
	/**
	 * Resource views directory
	 * @var string
	 */
	protected $resourceView = '';

	/**
	 * Model name of the resource, after initialization to a model instance
	 * @var string|Illuminate\Database\Eloquent\Model
	 */
	protected $model = '';

	/**
	 * Resource identification
	 * @var string
	 */
	protected $resource = '';

	/**
	 * Resource database tables
	 * @var string
	 */
	protected $resourceTable = '';

	/**
	 * Resource name (Chinese)
	 * @var string
	 */
	protected $resourceName = '';

	/**
	 * Custom validation message
	 * @var array
	 */
	protected $validatorMessages = array();

	/**
	 * Initialize
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		// Instantiate the resource model
		$this->model  = App::make($this->model);
		// View synthesizer
		$resource     = $this->resource;
		$resourceName = $this->resourceName;
		View::composer(array(
			$this->resourceView.'.index',
			$this->resourceView.'.create',
			$this->resourceView.'.edit',
		), function ($view) use ($resource, $resourceName) {
			$view->with(compact('resource', 'resourceName'));
		});
	}

	/**
	 * Resource list view
	 * GET         /resource
	 * @return Response
	 */
	public function index()
	{
		$datas = $this->model->orderBy('created_at', 'DESC')->paginate(15);
		return View::make($this->resourceView.'.index')->with(compact('datas'));
	}

	/**
	 * Resource create view
	 * GET         /resource/create
	 * @return Response
	 */
	public function create()
	{
		return View::make($this->resourceView.'.create');
	}

	/**
	 * Resource show view
	 * GET         /resource/{id}
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Source edit view
	 * GET         /resource/{id}/edit
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = $this->model->find($id);
		return View::make($this->resourceView.'.edit')->with('data', $data);
	}

	/**
	 * Resource edit action
	 * PUT/PATCH   /resource/{id}
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// Get all form data.
		$data = Input::all();
		// Create validation rules
		$rules = array(
			# --- --- --- --- --- --- --- --- --- --- Add a validation rule here #
		);
		// Custom validation message
		$messages  = $this->validatorMessages;
		// Begin verification
		$validator = Validator::make($data, $rules, $messages);
		if ($validator->passes()) {
			// Verification success
			// Update resource
			$model = $this->model->find($id);
			# --- --- --- --- --- --- --- --- --- --- Assigned to the model object property values here #
			if ($model->save()) {
				// Update success
				return Redirect::back()
					->with('success', '<strong>'.$this->resourceName.'Update success：</strong>您可以继续编辑'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
			} else {
				// Update fail
				return Redirect::back()
					->withInput()
					->with('error', '<strong>'.$this->resourceName.'Update fail。</strong>');
			}
		} else {
			// Verification fail
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}

	/**
	 * Resource destory action
	 * DELETE      /resource/{id}
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$data = $this->model->find($id);
		if (is_null($data))
			return Redirect::back()->with('error', '没有找到对应的'.$this->resourceName.'。');
		elseif ($data->delete())
			return Redirect::back()->with('success', $this->resourceName.'删除成功。');
		else
			return Redirect::back()->with('warning', $this->resourceName.'删除失败。');
	}

	/**
	 * Resource resource
	 * GET      /resource/recycled
	 * @param  int  $id
	 * @return Response
	 */
	public function recycled()
	{
		//
	}

	/**
	 * Resource restore
	 * PATCH      /resource/{id}
	 * @param  int  $id
	 * @return Response
	 */
	public function restore($id)
	{
		//
	}

	/**
	 * Structure unique verification rules
	 * @param  string $column Field name
	 * @param  int    $id     Excludes the specified ID
	 * @return string
	 */
	protected function unique($column = null, $id = null)
	{
		if (is_null($column))
			return 'unique:'.$this->resourceTable;
		else
			return 'unique:'.$this->resourceTable.','.$column.','.$id;
	}

}