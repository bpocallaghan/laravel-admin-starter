<?php

namespace App\Models;

use App\Models\Traits\Documentable;
use Titan\Models\TitanCMSModel;
use Bpocallaghan\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DocumentCategory
 * @mixin \Eloquent
 */
class DocumentCategory extends TitanCMSModel
{
    use SoftDeletes, HasSlug, Documentable;

    protected $table = 'document_categories';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'name' => 'required|min:3:max:255',
    ];

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllList()
    {
    	return self::orderBy('name')->get()->pluck('name', 'id')->toArray();
    }
}