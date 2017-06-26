<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogActivity extends Model
{
    protected $table = 'log_activities';

    protected $guarded = ['id'];

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
     * @param int $limit
     * @return mixed
     */
    static public function getLatest($limit = 200)
    {
        return self::with('subject')->orderBy('created_at', 'DESC')->limit($limit)->get();
    }

    /**
     * Get the latest activities on the site
     * @param int $minutes
     * @return mixed
     */
    static public function getLatestMinutes($minutes = 24 * 60)
    {
        $date = Carbon::now()->subMinutes($minutes);

        return self::where('created_at', '>=', $date)->orderBy('created_at', 'DESC')->get();
    }
}