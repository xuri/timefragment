<?php

use \Michelf\MarkdownExtra;

/**
 * Product
 */
class ShoppingCart extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'product_cart';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = false;

    /**
     * 模型对象关系：商品的出售者
     * @return object User
     */
    public function seller()
    {
        return $this->belongsTo('User', 'user_id');
    }


}