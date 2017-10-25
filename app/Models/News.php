<?php

namespace App\Models;

use App\Models\Traits\Photoable;
use App\User;
use Bpocallaghan\Sluggable\HasSlug;
use Bpocallaghan\Sluggable\SlugOptions;
use Titan\Models\TitanCMSModel;
use Titan\Models\Traits\ActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class News
 * @mixin \Eloquent
 */
class News extends TitanCMSModel
{
    use SoftDeletes, HasSlug, ActiveTrait, Photoable;

    protected $table = 'news';

    protected $guarded = ['id'];

    protected $dates = ['active_form', 'active_to'];

    public static $LARGE_SIZE = [920, 400];

    public static $THUMB_SIZE = [460, 200];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'title'       => 'required|min:3:max:255',
        'content'     => 'required|min:5:max:2000',
        'category_id' => 'required|exists:news_categories,id',
        'active_from' => 'nullable|date',
        'active_to'   => 'nullable|date',
    ];

    /**
     * Get the summary text
     *
     * @return mixed
     */
    public function getSummaryAttribute()
    {
        if ($this->attributes['summary']) {
            return $this->attributes['summary'];
        }

        return substr(strip_tags($this->attributes['content']), 0, 120);
    }

    /**
     * Get the createdBy
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the category
     */
    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id', 'id');
    }

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllList()
    {
        return self::orderBy('name')->get()->pluck('name', 'id')->toArray();
    }

    /**
     * Get the options for generating the slug.
     */
    protected function getSlugOptions()
    {
        return SlugOptions::create()->generateSlugFrom('title');
    }
}