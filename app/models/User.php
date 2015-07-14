<?php

/**
 * User
 */

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends BaseModel implements UserInterface, RemindableInterface
{
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Database table (without prefix)
     * @var string
     */
    protected $table = 'users';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /**
     * Access control: Friendly signin_at
     * @return string
     */
    public function getFriendlySigninAtAttribute()
    {
        if (is_null($this->signin_at))
            return '新账号尚未登录';
        else
            return friendly_date($this->signin_at);
    }

    /**
     * Access control: Portrait Large
     * @return string Portrait URI
     */
    public function getPortraitLargeAttribute()
    {
        if ($this->portrait)
            return asset('portrait/large/'.$this->portrait);
        else
            return with(new Identicon)->getImageDataUri($this->email, 220);
    }

    /**
     * Access control: Portrait Medium
     * @return string Portrait URI
     */
    public function getPortraitMediumAttribute()
    {
        if ($this->portrait)
            return asset('portrait/medium/'.$this->portrait);
        else
            return with(new Identicon)->getImageDataUri($this->email, 128);
    }

    /**
     * Access control: Portrait Small
     * @return string Portrait URI
     */
    public function getPortraitSmallAttribute()
    {
        if ($this->portrait)
            return asset('portrait/small/'.$this->portrait);
        else
            return with(new Identicon)->getImageDataUri($this->email, 64);
    }

    /**
     * Adjuster: Password
     * @param  string $value Untreated password string
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        // If the incoming string has been encrypted Hash, the iterative process is not
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    public function orders()
    {
        return $this->hasMany("Order");
    }

}