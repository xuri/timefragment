<?php
/**
 * 去旅行的分享评论
 */
class TravelComment extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'travel_comments';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：归属文章
     * @return object Article
     */
    public function travel()
    {
        return $this->belongsTo('Travel', 'creative_id');
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