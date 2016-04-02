<?php

namespace Titan\Models\Traits;

use Carbon\Carbon;

trait ActiveTrait
{
    /**
     * Format the posted date for display
     *
     * @return mixed
     */
    public function getPostedAtAttribute()
    {
        return $this->active_from->format('D, j M Y');
    }

    /**
     * Get the active from carbon instance
     *
     * @return static
     */
    public function getActiveFromAttribute()
    {
        return Carbon::createFromTimestamp(strtotime($this->attributes['active_from']));
    }

    /**
     * If Empty String, dont insert date
     *
     * @param $value
     */
    public function setActiveFromAttribute($value)
    {
        $this->attributes['active_from'] = (strlen($value) > 2 ? $value : Carbon::now());
    }

    /**
     * If Empty String, dont insert date
     *
     * @param $value
     */
    public function setActiveToAttribute($value)
    {
        $this->attributes['active_to'] = (strlen($value) > 2 ? $value : null);
    }

    /**
     * Add filter to only get the active items based on the dates, if they are set
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->whereRaw("(active_from IS NULL OR active_from <= '" . Carbon::now() . "')")
            ->whereRaw("(active_to IS NULL OR active_to >= '" . Carbon::now() . "')");
    }
}