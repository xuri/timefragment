<?php

class BaseModel extends Eloquent
{
    /**
     * Access control: Friendly created_at
     * @return string
     */
    public function getFriendlyCreatedAtAttribute()
    {
        return friendly_date($this->created_at);
    }

    /**
     * Access control: Friendly updated_at
     * @return string
     */
    public function getFriendlyUpdatedAtAttribute()
    {
        return friendly_date($this->updated_at);
    }

    /**
     * Access control: Friendly deleted_at
     * @return string
     */
    public function getFriendlyDeletedAtAttribute()
    {
        return friendly_date($this->deleted_at);
    }

}
