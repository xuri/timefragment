<?php

/**
 * Job comments
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class JobComment extends BaseModel
{
    /**
     * Database table (without prefix)
     * @var string
     */
    protected $table = 'job_comments';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * ORM (Object-relational model): Job
     * @return object Article
     */
    public function job()
    {
        return $this->belongsTo('Job', 'job_id');
    }

    /**
     * ORM (Object-relational model): User
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }


}
