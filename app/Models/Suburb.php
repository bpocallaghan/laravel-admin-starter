<?php

namespace App\Models;

use Titan\Models\TitanCMSModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suburb extends TitanCMSModel
{
    use SoftDeletes;

    protected $table = 'suburbs';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'title'   => 'required|min:3:max:255',
        'city_id' => 'required|exists:cities,id',
    ];

    /**
     * Get the province
     */
    public function city()
    {
        return $this->belongsTo(City::class);
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