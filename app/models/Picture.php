<?php

/**
 * About Article Pictures
 */
class Picture extends BaseModel
{
    /**
     * Database table name (without prefix)
     * @var string
     */
    protected $table = 'article_pictures';

    /**
     * Soft delete
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * Object-relational model: Vesting article
     * @return object Article
     */
    public function article()
    {
        return $this->belongsTo('Article', 'article_id');
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