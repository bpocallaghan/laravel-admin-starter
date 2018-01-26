<?php

namespace App;

use App\Models\Traits\UserAdmin;
use App\Models\Traits\UserHelper;
use App\Models\Traits\UserRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, UserHelper, UserRoles, UserAdmin;

    protected $appends = ['fullname'];

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
        'telephone',
        'image',
        'born_at',
        'logged_in_as',
        'security_level',
        'password',
        'session_token',
        'logged_in_at',
        'confirmation_token',
        'confirmed_at',
        'disabled_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'deleted_by',
        'deleted_at',
        'logged_in_at',
        'confirmation_token',
        'disabled_at'
    ];

    protected $dates = ['confirmed_at', 'deleted_at', 'logged_in_at', 'activated_at'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'firstname' => 'required',
        'lastname'  => 'required',
        //'gender'    => 'required|in:male,female',
        'email'     => 'required|email|unique:users',
        'password'  => 'required|min:4|confirmed',
        //'token'     => 'required|exists:user_invites,token',

        //'cellphone' => 'required|min:3:max:255',
        //'photo'     => 'required|image|max:6000|mimes:jpg,jpeg,png,bmp',
    ];

    /**
     * Validation rules for this model
     */
    static public $rulesProfile = [
        'firstname' => 'required',
        'lastname'  => 'required',
        'gender'    => 'required|in:male,female',
        'telephone' => 'nullable|min:9',
        'password'  => 'nullable|min:4|confirmed',
        'photo'     => 'required|image|max:6000|mimes:jpg,jpeg,png,bmp',
    ];
}
