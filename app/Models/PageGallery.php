<?php

namespace App\Models;

use App\Models\Traits\Photoable;
use Titan\Models\TitanCMSModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PageGallery
 * @mixin \Eloquent
 */
class PageGallery extends TitanCMSModel
{
    use SoftDeletes, Photoable;

    protected $table = 'page_gallery';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'heading'         => 'required|min:3:max:255',
        'heading_element' => 'required|max:2',
        'content'         => 'nullable|max:3000',
        'page_id'         => 'required|exists:pages,id',
    ];
}