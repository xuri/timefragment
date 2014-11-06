<?php

/**
 * Product comments
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductComment extends BaseModel
{
	/**
	 * Database table (without prefix)
	 * @var string
	 */
	protected $table = 'product_comments';

	/**
	 * Soft delete
	 * @var boolean
	 */
	use SoftDeletingTrait;

	protected $softDelete = ['deleted_at'];

	/**
	 * ORM (Object-relational model): Product
	 * @return object Article
	 */
	public function product()
	{
		return $this->belongsTo('Product', 'product_id');
	}

	/**
	 * ORM (Object-relational model): Comment author
	 * @return object User
	 */
	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}


}