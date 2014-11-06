<?php

/**
 * Creative comments
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CreativeComment extends BaseModel
{
	/**
	 * Database table (without prefix)
	 * @var string
	 */
	protected $table = 'creative_comments';

	/**
	 * Soft delete
	 * @var boolean
	 */
	use SoftDeletingTrait;

	protected $softDelete = ['deleted_at'];

	/**
	 * ORM (Object-relational model): Creative
	 * @return object Article
	 */
	public function creative()
	{
		return $this->belongsTo('Creative', 'creative_id');
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