<?php

/**
 * Shopping Cart
 */

use \Michelf\MarkdownExtra;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ShoppingCart extends BaseModel
{
    /**
     * Database table (without prefix)
     * @var string
     */
    protected $table = 'product_cart';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * ORM (Object-relational model): Saller
     * @return object User
     */
    public function seller()
    {
        return $this->belongsTo('User', 'user_id');
    }

}
