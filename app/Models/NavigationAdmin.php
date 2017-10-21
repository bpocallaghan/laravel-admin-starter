<?php

namespace App\Models;

use Titan\Models\TitanAdminNavigation;

class NavigationAdmin extends TitanAdminNavigation
{
    /**
     * Get the roles
     * @return \Eloquent
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'navigation_admin_role')->withTimestamps();
    }

    public function getRolesStringAttribute()
    {
        return implode(', ', $this->roles()->get()->pluck('name', 'id')->toArray());
    }

    /**
     * Get a the title + url concatenated
     *
     * @return string
     */
    public function getTitleUrlAttribute()
    {
        $name = $this->attributes['title'] . ' ( ' . $this->attributes['url'] . ' )';
        if ($this->parent) {
            $name .= " - {$this->parent->title}";
        }

        return $name;
    }

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllLists()
    {
        return self::with('parent')->orderBy('title')->get()->pluck('title_url', 'id')->toArray();
    }
}