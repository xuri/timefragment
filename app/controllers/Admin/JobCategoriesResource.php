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

class Admin_JobCategoriesResource extends BaseResource
{
	/**
	 * Resource view directory
	 * @var string
	 */
	protected $resourceView = 'admin.job_categories';

	/**
	 * Model name of the resource, after initialization to a model instance
	 * @var string|Illuminate\Database\Eloquent\Model
	 */
	protected $model = 'JobCategories';

	/**
	 * Resource identification
	 * @var string
	 */
	protected $resource = 'job_categories';

	/**
	 * Resource database tables
	 * @var string
	 */
	protected $resourceTable = 'job_categories';

	/**
	 * Resource name (Chinese)
	 * @var string
	 */
	protected $resourceName = '酷工作分类';

	/**
	 * Custom validation message
	 * @var array
	 */
	protected $validatorMessages = array(
		'name.required'			=> '请填写工作分类名称。',
		'name.unique'			=> '已有同名分类。',
		'sort_order.required'	=> '请填写分类排序。',
		'sort_order.integer'	=> '请填写一个整数。',
		'content.required'		=> '请填写简介。',
	);

	/**
	 * Resource list view
	 * GET         /resource
	 * @return Response
	 */
	public function index()
	{
		$datas = $this->model->where('cat_status', 'open')->orderBy('sort_order')->paginate(15);
		return View::make($this->resourceView.'.index')->with(compact('datas'));
	}

	/**
	 * Resource create view
	 * GET         /resource/create
	 * @return Response
	 */
	public function create()
	{
		$exist = $this->model->where('cat_status', 'close')->first();
		if($exist)
		{
			return Redirect::route($this->resource.'.newCat', $exist->id);
		} else {
			$model				= $this->model;
			$model->name		= '';
			$model->sort_order	= '';
			$model->content		= '';
			$model->save();
			return Redirect::route($this->resource.'.newCat', $model->id);
		}
	}

	/**
	 * Resource create view
	 * GET         /resource/create
	 * @return Response
	 */
	public function newCat($id)
	{
		$data = $this->model->find($id);
		return View::make($this->resourceView.'.create')->with('data', $data);
	}

	/**
	 * Resource create action
	 * POST        /resource
	 * @return Response
	 */
	public function store($id)
	{
		// Get all form data.
		$data	= Input::all();
		// Create validation rules
		$unique	= $this->unique();
		$rules	= array(
			'name'			=> 'required|'.$unique,
			'sort_order'	=> 'required|integer',
			'content'		=> 'required|',
		);
		// Custom validation message
		$messages	= $this->validatorMessages;
		// Begin verification
		$validator	= Validator::make($data, $rules, $messages);
		if ($validator->passes()) {
			// Verification success
			// Add resource
			$model				= $this->model->find($id);
			$model->name		= e($data['name']);
			$model->sort_order	= e($data['sort_order']);
			$model->content		= e($data['content']);
			$model->cat_status	= 'open';
			if ($model->save()) {
				// Add success
				return Redirect::route($this->resource.'.edit', $model->id)
					->with('success', '<strong>'.$this->resourceName.'添加成功：</strong>您可以继续添编辑'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
			} else {
				// Add fail
				return Redirect::back()
					->withInput()
					->with('error', '<strong>'.$this->resourceName.'添加失败。</strong>');
			}
		} else {
			// Verification fail
			return Redirect::back()->withInput()->withErrors($validator);
		}
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
		$data	= Input::all();
		// Create validation rules
		$rules	= array(
			'name'			=> 'required|'.$this->unique('name', $id),
			'sort_order'	=> 'required|integer',
			'content'		=> 'required|',
		);
		// Custom validation message
		$messages	= $this->validatorMessages;
		// Begin verification
		$validator	= Validator::make($data, $rules, $messages);
		if ($validator->passes()) {
			// Verification success
			// Update resource
			$model				= $this->model->find($id);
			$model->name		= e($data['name']);
			$model->sort_order	= e($data['sort_order']);
			$model->content		= e($data['content']);
			if ($model->save()) {
				// Update success
				return Redirect::back()
					->with('success', '<strong>'.$this->resourceName.'更新成功：</strong>您可以继续编辑'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
			} else {
				// Update fail
				return Redirect::back()
					->withInput()
					->with('error', '<strong>'.$this->resourceName.'更新失败。</strong>');
			}
		} else {
			// Verification fail
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}

	/**
	 * Action: Add resource images
	 * @return Response
	 */
	public function postUpload($id)
	{
		$input	= Input::all();
		$rules	= array(
			'file' => 'image|max:3000',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails())
		{
			return Response::make($validation->errors->first(), 400);
		}

		$file				= Input::file('file');
		$destinationPath	= 'uploads/job_category_thumbnails/';
		$ext				= $file->guessClientExtension();  // Get real extension according to mime type
		$fullname			= $file->getClientOriginalName(); // Client file name, including the extension of the client
		$hashname			= date('H.i.s').'-'.md5($fullname).'.'.$ext; // Hash processed file name, including the real extension

		$model				= $this->model->find($id);
		$oldThumbnails		= $model->thumbnails;
		$model->thumbnails	= $hashname;
		$model->save();

		$thumbnails			= Image::make($file->getRealPath());
		$upload_success		= $thumbnails->fit(105, 105)->save(public_path($destinationPath.$hashname));

		File::delete(public_path('uploads/job_category_thumbnails/'.$oldThumbnails));

		if( $upload_success ) {
		   return Response::json('success', 200);
		} else {
		   return Response::json('error', 400);
		}
	}

	/**
	 * Action: Delete resource images
	 * @return Response
	 */
	public function deleteUpload($id)
	{
		// Only allow delete operations to the picture on the cover of the current resource
		$model		= $this->model->find($id);
		$thumbnails	= $model->thumbnails;

		if (is_null($thumbnails)) {
			return Redirect::back()->with('error', '没有找到对应的图片');
		} elseif ($thumbnails) {
			File::delete(public_path('uploads/job_category_thumbnails/'.$thumbnails));
			$model->thumbnails = NULL;
			$model->save();
			return Redirect::back()->with('success', '图片删除成功。');
		} else {
			return Redirect::back()->with('warning', '图片删除失败。');
		}
	}


}