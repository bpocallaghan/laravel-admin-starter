<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PageSection
 * @mixin \Eloquent
 */
class PageSection extends Model
{
    protected $table = 'page_sections';

    protected $guarded = ['id'];

    static public $TYPE_CONTENT = 'content';

    static public $TYPE_MEDIA = 'media';

    static public $TYPE_GALLERY = 'gallery';

    /**
     * Get the page
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Morph the component relationship
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function component()
    {
        return $this->morphTo();
    }

    /**
     * Get the type of component
     * @return string
     */
    public function getTypeAttribute()
    {
        $class = $this->component_type;
        $function = new \ReflectionClass($class);
        $type = str_replace('Page', '', $function->getShortName());

        return strtolower($type);
    }
}