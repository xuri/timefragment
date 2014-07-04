<?php

/**
 * Product Pictures
 */
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
    protected $softDelete = true;

    /**
     * Object-relational model: Vesting product
     * @return object Product
     */
    public function product()
    {
        return $this->belongsTo('Product', 'product_id');
    }

    /**
     * 模型对象关系：评论的作者
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

}