<?php

/**
 * Travel Category
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class TravelCategories extends BaseModel
{
	/**
	 * Database table (without prefix)
	 * @var string
	 */
	protected $table = 'travel_categories';

	/**
	 * Soft delete
	 * @var boolean
	 */
	use SoftDeletingTrait;

	protected $softDelete = ['deleted_at'];

	/**
	 * ORM (Object-relational model): Travel
	 * @return object Illuminate\Database\Eloquent\Collection
	 */
	public function travel()
	{
		return $this->hasMany('Travel', 'category_id');
	}


}