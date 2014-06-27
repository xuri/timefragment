<?php
/**
 * 创意分享评论
 */
class CreativeComment extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'creative_comments';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：归属创意
     * @return object Article
     */
    public function creative()
    {
        return $this->belongsTo('Creative', 'creative_id');
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