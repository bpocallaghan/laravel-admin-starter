<?php

namespace App\Models;

use Titan\Models\TitanCMSModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends TitanCMSModel
{
    use SoftDeletes;

    protected $table = 'countries';

    protected $guarded = ['id'];

    protected $hidden = [
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
        'zoom_level',
        'latitude',
        'longitude',
    ];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'title'        => 'required|min:3:max:255',
        'abbreviation' => 'required|min:2:max:3',
    ];

    public function getTitleAbrAttribute()
    {
        return $this->attributes['title'] . ' (' . $this->attributes['abbreviation'] . ')';
    }

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllLists()
    {
        return self::orderBy('title')->get()->pluck('title_abr', 'id')->toArray();
    }
}