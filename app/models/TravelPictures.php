<?php

/**
 * Travel Pictures
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class TravelPictures extends BaseModel
{
    /**
     * Database table name (without prefix)
     * @var string
     */
    protected $table = 'travel_pictures';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * ORM (Object-relational model): Travel
     * @return object Creative
     */
    public function travel()
    {
        return $this->belongsTo('Travel', 'travel_id');
    }

    /**
     * ORM (Object-relational model): Travel author
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

}
