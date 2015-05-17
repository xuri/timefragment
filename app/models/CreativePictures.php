<?php

/**
 * Creative Pictures
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

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
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * Object-relational model: Creative
     * @return object Creative
     */
    public function creative()
    {
        return $this->belongsTo('Creative', 'creative_id');
    }

    /**
     * Object-relational model: Creative author
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }


}
