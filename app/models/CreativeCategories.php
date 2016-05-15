<?php

/**
 * Creative category
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CreativeCategories extends BaseModel
{
    /**
     * Database table (without prefix)
     * @var string
     */
    protected $table = 'creative_categories';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * ORM (Object-relational model): Creative article
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function creative()
    {
        return $this->hasMany('Creative', 'category_id');
    }


}
