<?php

namespace App\Models;

use Titan\Models\TitanCMSModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends TitanCMSModel
{
    use SoftDeletes;

    protected $table = 'testimonials';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'customer'    => 'required|min:3:max:255',
        'description' => 'required',
    ];
}