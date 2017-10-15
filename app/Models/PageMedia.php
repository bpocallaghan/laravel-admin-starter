<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;
use Titan\Models\Traits\ImageThumb;

/**
 * Class PageMedia
 * @mixin \Eloquent
 */
class PageMedia extends TitanCMSModel
{
    use SoftDeletes, ImageThumb;

    protected $table = 'page_media';

    protected $guarded = ['id'];

    public $imageColumn = 'media';

    static $alignments = [
        //'bottom' => 'Bottom',
        //'center' => 'Center',
        'left'   => 'Left',
        'right'  => 'Right',
        'top'    => 'Top',
    ];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'heading'         => 'required|min:3:max:255',
        'heading_element' => 'required|max:2',
        'content'         => 'required|max:3000',
        'page_id'         => 'required|exists:pages,id',
        'caption'         => 'nullable|max:240',
        'media'           => 'required|image|max:3000|mimes:jpg,jpeg,png,bmp',
        'media_align'     => 'required|max:20',
    ];

    /**
     * Get the summary text
     *
     * @return mixed
     */
    public function getSummaryAttribute()
    {
        return substr(strip_tags($this->attributes['content']), 0, 120) . '...';
    }
}