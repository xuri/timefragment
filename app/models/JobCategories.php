<?php

/**
 * Job Category
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class JobCategories extends BaseModel
{
	/**
	 * Database table (without prefix)
	 * @var string
	 */
	protected $table = 'job_categories';

	/**
	 * Soft delete
	 * @var boolean
	 */
	use SoftDeletingTrait;

	protected $softDelete = ['deleted_at'];

	/**
	 * ORM (Object-relational model): Jobs
	 * @return object Illuminate\Database\Eloquent\Collection
	 */
	public function job()
	{
		return $this->hasMany('Job', 'category_id');
	}


}