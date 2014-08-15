<?php

/**
 * Timeline
 */

use \Michelf\MarkdownExtra;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Timeline extends BaseModel
{
    /**
     * Database table (without prefix)
     * @var string
     */
    protected $table = 'timeline';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];


    /**
     * ORM (Object-relational model): User
     * @return object User
     */
    public function timeline()
    {
        return $this->belongsTo('User', 'user_id');
    }


}