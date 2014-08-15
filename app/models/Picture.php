<?php

/**
 * Article Pictures
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Picture extends BaseModel
{
    /**
     * Database table (without prefix)
     * @var string
     */
    protected $table = 'article_pictures';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * ORM (Object-relational model): Article
     * @return object Article
     */
    public function article()
    {
        return $this->belongsTo('Article', 'article_id');
    }

    /**
     * ORM (Object-relational model): Comment author
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }


}