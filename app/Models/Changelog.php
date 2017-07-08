<?php

namespace App\Models;

use Titan\Models\TitanCMSModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Changelog extends TitanCMSModel
{
    use SoftDeletes;

    protected $table = 'changelogs';

    protected $guarded = ['id'];

    protected $dates = ['date_at'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'version' => 'required|min:1:max:255',
        'date_at' => 'required|date',
        'content' => 'required',
    ];

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllLists()
    {
        return self::orderBy('title')->get()->pluck('title', 'id')->toArray();
    }
}