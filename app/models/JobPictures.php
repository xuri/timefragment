<?php

/**
 * Job Pictures
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class JobPictures extends BaseModel
{
    /**
     * Database table name (without prefix)
     * @var string
     */
    protected $table = 'job_pictures';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * ORM (Object-relational model): Job
     * @return object Creative
     */
    public function job()
    {
        return $this->belongsTo('Job', 'job_id');
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
