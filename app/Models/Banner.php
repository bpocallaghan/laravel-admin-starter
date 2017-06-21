<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;
use Titan\Models\Traits\ActiveTrait;
use Titan\Models\Traits\ImageThumb;

class Banner extends TitanCMSModel
{
    use SoftDeletes, ActiveTrait, ImageThumb;

    protected $table = 'banners';

    protected $guarded = ['id'];

    protected $dates = ['active_form', 'active_to'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'title' => 'required|min:3:max:255',
        'photo' => 'required|image|max:6000|mimes:jpg,jpeg,png,bmp',
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