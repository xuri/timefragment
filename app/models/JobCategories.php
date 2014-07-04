<?php
/**
 * 兼职分类
 */
class JobCategories extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'job_categories';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：兼职分类下的文章
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function job()
    {
        return $this->hasMany('Job', 'category_id');
    }

}