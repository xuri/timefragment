<?php
/**
 * 商品评论
 */
class ProductComment extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'product_comments';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：归属创意
     * @return object Article
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