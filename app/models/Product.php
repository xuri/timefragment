<?php

/**
 * Product
 */

use \Michelf\MarkdownExtra;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Product extends BaseModel
{
    /**
     * Database table (without prefix)
     * @var string
     */
    protected $table = 'products';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * ORM (Object-relational model): Product category
     * @return object Category
     */
    public function category()
    {
        return $this->belongsTo('ProductCategories', 'category_id');
    }

    /**
     * ORM (Object-relational model): Goods saller
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * ORM (Object-relational model): Goods comments
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function comments()
    {
        return $this->hasMany('ProductComment', 'product_id');
    }

    /**
     * ORM (Object-relational model): Goods pictures
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function pictures()
    {
        return $this->hasMany('ProductPictures', 'product_id');
    }

    /**
     * Access control: Content (original)
     * @return string
     */
    public function getContentAttribute($value)
    {
        return strip($value);
    }

    /**
     * Access control: Abstract (original)
     * @return string
     */
    public function getExcerptAttribute($value)
    {
        return strip($value);
    }


}
