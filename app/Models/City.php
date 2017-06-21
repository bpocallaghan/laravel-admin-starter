<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;

class City extends TitanCMSModel
{
    use SoftDeletes;

    protected $table = 'cities';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'title'       => 'required|min:3:max:255',
        'province_id' => 'required|exists:provinces,id',
    ];

    /**
     * Get the province
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    
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