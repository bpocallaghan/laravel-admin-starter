<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserInvite extends Model
{
    protected $table = 'user_invites';

    protected $guarded = ['id'];

    protected $dates = ['claimed_at'];

    /**
     * Hash the password attribute before insert into the database
     *
     * @param [string] $password
     */
    public function setInvitedByAttribute($invited_by)
    {
        $this->attributes['invited_by'] = user()->id;
    }

    /**
     * Set the unique token
     *
     * @param [string] $token
     */
    public function setTokenAttribute($token)
    {
        $this->attributes['token'] = $this->getUniqueToken();
    }

    private function getUniqueToken()
    {
        $token = token($this->email);
        if (self::whereToken($token)->first()) {
            return $this->getUniqueToken();
        }

        return $token;
    }

    /**
     * Get the user that sent invite to email
     *
     * @return \Eloquent
     */
    public function invitedBy()
    {
        return $this->belongsTo(User::class, 'invited_by', 'id');
    }
}