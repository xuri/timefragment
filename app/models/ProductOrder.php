<?php

use \Michelf\MarkdownExtra;

/**
 * ProductOrder
 */
class ProductOrder extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'product_orders';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：订单
     * @return object User
     */
    public function order()
    {
        return $this->belongsTo('User', 'user_id');
    }

}