<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'gender',
        'cellphone',
        'image',
        'password',
        'session_token',
        'registered_at',
        'logged_in_at',
        'confirmation_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'deleted_by',
        'deleted_at',
        'logged_in_at',
        'confirmation_token'
    ];

    protected $dates = ['registered_at', 'deleted_at', 'logged_in_at'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'firstname' => 'required|min:3:max:255',
        'lastname'  => 'required|min:3:max:255',
        'email'     => 'required|min:3:max:255',
        'gender'    => 'required|min:3:max:255',
        'cellphone' => 'required|min:3:max:255',
        'photo'     => 'required|image|max:6000|mimes:jpg,jpeg,png,bmp',
    ];

    /**
     * Get the user fullname (firstname + lastname)
     *
     * @return string
     */
    public function getFullnameAttribute()
    {
        return $this->attributes['firstname'] . ' ' . $this->attributes['lastname'];
    }

    /**
     * Set the unique confirmation_token
     *
     * @param [string] $confirmation_token
     */
    public function setConfirmationTokenAttribute($value)
    {
        $this->attributes['confirmation_token'] = $this->getUniqueConfirmationToken();
    }

    private function getUniqueConfirmationToken()
    {
        $token = token($this->email);
        if (self::where('confirmation_token', $token)->first()) {
            return $this->getUniqueConfirmationToken();
        }

        return $token;
    }
}
