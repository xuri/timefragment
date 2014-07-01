<?php

/**
 * Jobs Pictures
 */
class JobsPictures extends BaseModel
{
    /**
     * Database table name (without prefix)
     * @var string
     */
    protected $table = 'jobs_pictures';

    /**
     * Soft delete
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * Object-relational model: Vesting creative
     * @return object Creative
     */
    public function jobs()
    {
        return $this->belongsTo('Jobs', 'jobs_id');
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