<?php

namespace Titan\Models\Traits;

trait ModifyBy
{

	/**
	 * Register the necessary event listeners.
	 *
	 * @return void
	 */
	protected static function bootModifyBy()
	{
		static::creating(function ($model)
		{
			$model->created_by = user()->id;
			$model->updated_by = user()->id;
		});

		static::updating(function ($model)
		{
            // if cronjob / no user
            if(user()->id >= 1) {
                $model->updated_by = user()->id;
            }
		});

		static::deleting(function ($model)
		{
			$model->deleted_by = user()->id;
			$model->save();
		});
	}
}