<?php

namespace App\Models;

use App\Models\Traits\Documentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;

/**
 * Class PageDocument
 * @mixin \Eloquent
 */
class PageDocument extends TitanCMSModel
{
    use SoftDeletes, Documentable;

    protected $table = 'page_documents';

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

    /**
     * Get the heading name
     * @return mixed
     */
    public function getNameAttribute()
    {
        return $this->heading;
    }
}