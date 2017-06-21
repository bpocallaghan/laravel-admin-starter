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
     * Get the top main level menu
     *
     * @param int $hidden
     * @return mixed
     */
    static public function mainNavigation($hidden = 0)
    {
        $builder = self::where('parent_id', 0)->where('is_main', 1);

        if ($hidden != 1) {
            $builder->where('is_hidden', $hidden);
        }

        return $builder->orderBy('list_main_order')->get();
    }

    /**
     * Get All navigation where parent id, and not hidden
     *
     * @param        $id
     * @param string $type
     * @param string $order
     * @param int    $hidden
     * @return mixed
     */
    static public function whereParentIdORM(
        $id,
        $type = 'main',
        $order = 'list_main_order',
        $hidden = 0
    ) {
        $query = self::whereParentId($id);

        switch ($type) {
            case 'footer';
                $query->where('is_footer', 1);
                break;
            default:
                $query->where('is_main', 1);
        }

        return $query->orderBy($order)->get();
    }

    /**
     * Get All navigation where parent id, and not hidden
     *
     * @param        $id
     * @param string $type
     * @return mixed
     */
    static public function parentIdAndType($id, $type = 'main')
    {
        $builder = self::where('parent_id', $id);
        $builder->where("is_$type", 1);
        $builder->where("is_hidden", 0);

        return $builder->orderBy("list_$type" . '_order')->get();
    }
}