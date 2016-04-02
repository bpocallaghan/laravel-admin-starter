<?php

namespace App\Models;

use Titan\Models\TitanCMSModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends TitanCMSModel
{
    use SoftDeletes;

    protected $table = 'cities';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'title' => 'required|min:3:max:255',
    ];

    public function getTitleCountryAttribute()
    {
        return $this->attributes['title'] . ' (' . ($this->country ? $this->country->title : '-') . ')';
    }

    /**
     * Get the country
     * @return \Eloquent
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllLists()
    {
        return self::with('country')
            ->orderBy('title')
            ->get()
            ->lists('title_country', 'id')
            ->toArray();
    }
}