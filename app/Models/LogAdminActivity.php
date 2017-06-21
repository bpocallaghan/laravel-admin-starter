<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class LogAdminActivity extends Model
{
    protected $table = 'log_admin_activities';

    protected $guarded = ['id'];

    /**
     * Get the user responsible for the given activity.
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subject of the activity.
     *
     * @return mixed
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Get the latest activities on the site
     * @return mixed
     */
    static public function getLatest()
    {
        return self::with('user')
            ->with('subject')
            ->orderBy('created_at', 'DESC')
            ->limit(100)
            ->get();
    }
}