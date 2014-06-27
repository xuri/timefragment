<?php
/**
 * 去旅行分类
 */
class TravelCategories extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'travel_categories';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：去旅行分类下的文章
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function travel()
    {
        return $this->hasMany('Travel', 'category_id');
    }

}