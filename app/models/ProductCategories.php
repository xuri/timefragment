<?php

/**
 * Categories
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductCategories extends BaseModel
{
    /**
     * Database table (without prefix)
     * @var string
     */
    protected $table = 'product_categories';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * ORM (Object-relational model): Goods in Category
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function product()
    {
        return $this->hasMany('Product', 'category_id');
    }


}
