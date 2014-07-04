<?php

use \Michelf\MarkdownExtra;

/**
 * Product
 */
class Product extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'products';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：商品的分类
     * @return object Category
     */
    public function category()
    {
        return $this->belongsTo('ProductCategories', 'category_id');
    }

    /**
     * 模型对象关系：商品的出售者
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * 模型对象关系：商品的评论
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function comments()
    {
        return $this->hasMany('ProductComment', 'product_id');
    }

    /**
     * 模型对象关系：商品的图片
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function pictures()
    {
        return $this->hasMany('ProductPictures', 'product_id');
    }

    /**
     * 访问器：商品内容（原始）
     * @return string
     */
    public function getContentAttribute($value)
    {
        return strip($value);
    }

    /**
     * 访问器：商品摘要（原始）
     * @return string
     */
    public function getExcerptAttribute($value)
    {
        return strip($value);
    }

}