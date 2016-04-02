<?php

namespace App\Models;

use Titan\Models\TitanAdminNavigation;

class NavigationAdmin extends TitanAdminNavigation
{
    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllLists()
    {
        return NavigationAdmin::orderBy('title')->get()->lists('title_url', 'id')->toArray();
    }
}