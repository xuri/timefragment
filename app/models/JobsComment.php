<?php
/**
 * 应聘职位的评论
 */
class JobsComment extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'jobs_comments';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：归属招聘
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