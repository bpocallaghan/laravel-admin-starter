<?php

namespace App\Models;

use Titan\Models\TitanWebsiteNavigation;

class NavigationWebsite extends TitanWebsiteNavigation
{
    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllLists()
    {
        return self::orderBy('title')->get()->pluck('title_url', 'id')->toArray();
    }

    /**
     * Get the banners
     * @return \Eloquent
     */
    public function banners()
    {
        return $this->belongsToMany(Banner::class);
    }

    /**
     * Get the top main level menu
     *
     * @return mixed
     */
    static public function mainNavigation()
    {
        return self::where('parent_id', 0)
            ->where('is_main', 1)
            ->where('is_hidden', 0)
            ->orderBy('list_main_order')
            ->get();
    }
}