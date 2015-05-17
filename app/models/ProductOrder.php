<?php

/**
 * Product Order
 */

use \Michelf\MarkdownExtra;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductOrder extends BaseModel
{
    /**
     * Database table (without prefix)
     * @var string
     */
    protected $table = 'product_orders';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * ORM (Object-relational model): Order
     * @return object User
     */
    public function order()
    {
        return $this->belongsTo('User', 'user_id');
    }


}
