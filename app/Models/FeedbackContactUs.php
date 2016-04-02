<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackContactUs extends Model
{
    protected $table = 'feedback_contact_us';

    protected $guarded = ['id'];

    /**
     * Validation custom messages for this model
     */
    static public $rules = [
        'firstname' => 'required|min:2:max:255',
        'lastname'  => 'required|min:2:max:255',
        'email'     => 'required|min:2:max:255|email',
    ];
}