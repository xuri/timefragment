<?php
/**
 * 商品分类
 */
class ProductCategories extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'product_categories';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：商品分类下的商品
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function product()
    {
        return $this->hasMany('Product', 'category_id');
    }

}