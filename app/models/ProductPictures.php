<?php

/**
 * Product Pictures
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductPictures extends BaseModel
{
	/**
	 * Database table name (without prefix)
	 * @var string
	 */
	protected $table = 'product_pictures';

	/**
	 * Soft delete
	 * @var boolean
	 */
	use SoftDeletingTrait;

	protected $softDelete = ['deleted_at'];

	/**
	 * ORM (Object-relational model): Product
	 * @return object Product
	 */
	public function product()
	{
		return $this->belongsTo('Product', 'product_id');
	}

	/**
	 * ORM (Object-relational model): Saller
	 * @return object User
	 */
	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}


}