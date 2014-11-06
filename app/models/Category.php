<?php

/**
 * Article categories
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends BaseModel
{
	/**
	 * Database table (without prefix)
	 * @var string
	 */
	protected $table = 'article_categories';

	/**
	 * Soft delete
	 * @var boolean
	 */
	use SoftDeletingTrait;

	protected $softDelete = ['deleted_at'];

	/**
	 * ORM (Object-relational model): Article in category
	 * @return object Illuminate\Database\Eloquent\Collection
	 */
	public function articles()
	{
		return $this->hasMany('Article', 'category_id');
	}


}