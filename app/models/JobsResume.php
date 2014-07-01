<?php
/**
 * 兼职应聘者
 */
class JobsResume extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'jobs_resume';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：归属文章
     * @return object Article
     */
    public function jobs()
    {
        return $this->belongsTo('Jobs', 'jobs_id');
    }

    /**
     * 模型对象关系：应聘者
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }


}