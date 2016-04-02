<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogSocialShare extends Model
{
    protected $table = 'log_social_shares';

    protected $guarded = ['id'];

    /**
     * Get the latest activities on the site
     * @return mixed
     */
    static public function getLatest()
    {
        return self::orderBy('created_at', 'DESC')->limit(50)->get();
    }
}