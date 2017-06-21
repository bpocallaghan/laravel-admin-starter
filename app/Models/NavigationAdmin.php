<?php

namespace App\Models;

use Titan\Models\TitanAdminNavigation;

class NavigationAdmin extends TitanAdminNavigation
{
    /**
     * Remove the ending '/'
     * @return string
     */
    public function getUrlAttribute()
    {
        return rtrim($this->attributes['url'], '/');
    }

    /**
     * Get the roles
     * @return \Eloquent
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'navigation_admin_role')->withTimestamps();
    }

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllLists()
    {
        return NavigationAdmin::orderBy('title')->get()->pluck('title_url', 'id')->toArray();
    }
}