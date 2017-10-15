<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;

/**
 * Class PostOffice
 * @mixin \Eloquent
 */
class PostOffice extends TitanCMSModel
{
    use SoftDeletes;

    protected $table = 'post_offices';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'name'           => 'required|min:3:max:255',
        'contact_person' => 'required|min:3:max:255',
        'email'          => 'required|min:3:max:255',
        'cellphone'      => 'nullable|min:3:max:255',
        'telephone'      => 'required|min:3:max:255',
        'fax'            => 'nullable|min:3:max:255',
        'suburb_id'      => 'required|exists:suburbs,id',
        'city_id'        => 'required|exists:cities,id',
        'address'        => 'required|min:5',
        'zoom_level'     => 'required',
        'latitude'       => 'required',
        'longitude'      => 'required',
    ];

    /**
     * Get the suburb
     */
    public function suburb()
    {
        return $this->belongsTo(Suburb::class);
    }

    /**
     * Get the city
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}