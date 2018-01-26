<?php

namespace App\Models;

use App\Models\Traits\PageHelper;
use Bpocallaghan\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;

/**
 * Class Page
 * @mixin \Eloquent
 */
class Page extends TitanCMSModel
{
    use SoftDeletes, PageHelper/*, HasSlug*/;

    protected $table = 'pages';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     *
     * @var array
     */
    static public $rules = [
        'name'          => 'required|min:3:max:255',
        'title'         => 'required|min:3:max:255',
        'description'   => 'required|min:3:max:255',
        'slug'          => 'nullable',
        'url'           => 'nullable',
        'icon'          => 'nullable',
        'is_header'     => 'nullable|in:0,on',
        'header_order'  => 'nullable|integer',
        'is_footer'     => 'nullable|in:0,on',
        'footer_order'  => 'nullable|digits',
        'is_hidden'     => 'nullable|in:0,on',
        'is_featured'   => 'nullable|in:0,on',
        'parent_id'     => 'nullable',
        'url_parent_id' => 'nullable',
        'url_parent_id' => 'nullable',
        //'banners'       => 'nullable',
        //'parent_id'     => 'nullable|exists:pages,id',
        //'url_parent_id' => 'nullable|exists:pages,id',
    ];

    /**
     * Get a the title + url concatenated
     *
     * @return string
     */
    public function getTitleUrlAttribute()
    {
        return $this->attributes['title'] . ' ( ' . $this->attributes['url'] . ' )';
    }

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllList()
    {
        return self::orderBy('name')->get()->pluck('title_url', 'id')->toArray();
    }

    /**
     * Get the sections
     */
    public function sections()
    {
        return $this->hasMany(PageSection::class, 'page_id', 'id')->orderBy('list_order');
    }

    /**
     * Get the components
     */
    public function components()
    {
        return $this->hasMany(PageSection::class, 'page_id', 'id')->orderBy('list_order');
    }

    /**
     * Get the Banner many to many
     */
    public function banners()
    {
        return $this->belongsToMany(Banner::class)->active()->orderBy('created_at', 'DESC');
    }

    /**
     * Get the PageContent many to many
     */
    public function pageContent()
    {
        return $this->belongsToMany(PageContent::class);
    }

    /**
     * Create and Attach a page component to this page
     * @param $item
     * @return bool
     */
    public function attachComponent($item)
    {
        // if already attached
        $found = PageSection::where('page_id', $this->id)
            ->where('component_id', $item->id)
            ->where('component_type', get_class($item))
            ->first();
        if ($found) {
            return true;
        }

        PageSection::create([
            'page_id'        => $this->id,
            'component_id'   => $item->id,
            'component_type' => get_class($item),
        ]);
    }
}