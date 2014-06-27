<?php

/**
 * Creative Pictures
 */
class CreativePictures extends BaseModel
{
    /**
     * Database table name (without prefix)
     * @var string
     */
    protected $table = 'creative_pictures';

    /**
     * Soft delete
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * Object-relational model: Vesting creative
     * @return object Creative
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