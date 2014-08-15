<?php

/**
 * Travel comments
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class TravelComment extends BaseModel
{
    /**
     * Database table (without prefix)
     * @var string
     */
    protected $table = 'travel_comments';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * ORM (Object-relational model): Travel
     * @return object Article
     */
    public function travel()
    {
        return $this->belongsTo('Travel', 'travel_id');
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