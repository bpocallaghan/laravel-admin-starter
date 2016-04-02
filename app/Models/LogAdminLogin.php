<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAdminLogin extends Model
{
    protected $table = 'log_admin_logins';

    protected $guarded = ['id'];

    /**
     * Make the update_at do nothing
     *
     * @return array
     */
    public function setUpdatedAtAttribute($value)
    {
        // Do nothing.
    }
}