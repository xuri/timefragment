<?php
/**
 * 创意汇分类
 */
class CreativeCategories extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'creative_categories';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：创意汇分类下的文章
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function creative()
    {
        return $this->hasMany('Creative', 'category_id');
    }

}