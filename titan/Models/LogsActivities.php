<?php

namespace Titan\Models;

use Illuminate\Database\Eloquent\Model;

class LogsActivities extends Model
{

	protected $table = 'logs_activities';

	protected $guarded = ['id'];

	/**
	 * Get the user responsible for the given activity.
	 *
	 * @return User
	 */
	public function user()
	{
		return $this->belongsTo('App\Models\User');
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
		return LogsActivities::with('user')->with('subject')->orderBy('created_at', 'DESC')->limit(50)->get();
	}

}
