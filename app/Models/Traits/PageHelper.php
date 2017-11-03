<?php

namespace App\Models\Traits;

use App\Models\Page;

trait PageHelper
{
    /**
     * Get the parent
     *
     * @return \Eloquent
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    /**
     * Get the parent
     *
     * @return \Eloquent
     */
    public function urlParent()
    {
        return $this->belongsTo(self::class, 'url_parent_id', 'id');
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
        $type = 'header',
        $order = 'header_order',
        $hidden = 0
    ) {
        $query = self::whereParentId($id);

        switch ($type) {
            case 'all':
                $order = 'header_order';
                $query->where('is_header', 0);
                $query->where('is_footer', 0);
                break;
            case 'footer';
                $query->where('is_footer', 1);
                break;
            default:
                $query->where('is_header', 1);
        }

        return $query->orderBy($order)->get();

        return $query->where('is_hidden', $hidden)->orderBy($order)->get();
    }

    /**
     * Get the url from db
     * If true given, we generate a new one,
     * This us usefull if parent_id updated, etc
     *
     * @return \Eloquent
     */
    public function updateUrl()
    {
        $this->url = '';
        $this->generateCompleteUrl($this);
        $this->url = $this->url;

        if (strlen($this->slug) > 1) {
            $this->url .= (is_slug_url($this->slug) ? "" : "/") . $this->slug;
        }

        return $this;
    }

    /**
     * Generate the new nav based on parent_id
     *
     * @param $nav
     * @return \Illuminate\Support\Collection|static
     */
    private function generateCompleteUrl($nav)
    {
        $row = self::find($nav->url_parent_id);

        if ($row) {
            if (strlen($row->slug) > 1) {
                $this->url = "/{$row->slug}" . ("{$this->url}");
            }

            return $this->generateCompleteUrl($row);
        }

        return $row;
    }

    /**
     * Get All his parents and himself
     *
     * @return mixed
     */
    public function getParentsAndYou()
    {
        return $this->getParentsRecursive($this, []);
    }

    /**
     * Recursive find his parents
     *
     * @param $nav
     * @param $parents
     * @return mixed
     */
    private function getParentsRecursive($nav, $parents)
    {
        if ($parent = $nav->parent) {
            $parents = $this->getParentsRecursive($parent, $parents);
        }

        array_push($parents, $nav);

        return $parents;
    }

    /**
     * Get All his parents and himself
     *
     * @return mixed
     */
    public function getUrlParentsAndYou()
    {
        return $this->getUrlParentsRecursive($this, []);
    }

    /**
     * Recursive find his parents
     *
     * @param $nav
     * @param $parents
     * @return mixed
     */
    private function getUrlParentsRecursive($nav, $parents)
    {
        if ($urlParent = $nav->urlParent) {
            $parents = $this->getUrlParentsRecursive($urlParent, $parents);
        }

        array_push($parents, $nav);

        return $parents;
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

    /**
     * Get all the navigation to render
     * Hide hidden
     * Order by list order
     * Group by parent_id
     * @return mixed
     */
    public static function getHeaderNavigation()
    {
        $builder = self::where('is_hidden', 0);
        $builder->where('is_header', 1);
        if (!\Auth::check()) {
            $builder->where('name', '!=', 'My Account');
        }
        $items = $builder->orderBy('header_order')
            ->select('id', 'icon', 'name', 'title', 'description', 'slug', 'url', 'parent_id',
                'views')
            ->get()
            ->groupBy('parent_id');

        if (count($items)) {
            $items['root'] = collect();
            if (isset($items['']) || isset($items[0])) {
                $items['root'] = isset($items['']) ? $items[''] : $items[0];
                unset($items['']);
                unset($items[0]);
            }
        }

        return $items;
    }

    public static function getFeatured()
    {
        return self::where('is_featured', 1)->orderBy('name')->get();
    }

    public static function getHeaderNavigationRight()
    {
        $filter = ['NamPost', 'Contact Us'];
        if (\Auth::check()) {
            $filter[] = 'My Account';
        }
        $items = Page::getHeaderNavigation();

        // strip out the not needed ones
        if ($items['root']) {
            $items['root'] = $items['root']->filter(function ($item) use ($filter) {
                return in_array($item->name, $filter);
            });
        }

        return $items;
    }

    public static function getFooterNavigationRight()
    {
        // about
        $items = Page::with('parent')
            ->where('is_hidden', 0)
            ->whereIn('parent_id', [15, 26, 6])
            ->orderBy('header_order')
            ->select('id', 'icon', 'name', 'title', 'description', 'slug', 'url', 'parent_id')
            ->get();

        $items = $items->groupBy(function ($item) {
            return $item->parent->name;
        });

        // rename
        //if ($items['About Us']) {
        //    $items['NamPost'] = $items['About Us'];
        //    unset($items['About Us']);
        //}

        return $items;
    }

    /**
     * Get the popular pages
     * @return static
     */
    public static function getPopularPages()
    {
        // exclude pages
        $ids = Page::where('slug', '/')
            ->orWhere('url', '=', '')
            ->orWhere('url', 'LIKE', '/auth%')
            ->orWhere('url', 'LIKE', '/account%')
            ->get()
            ->pluck('id', 'id')
            ->values()
            ->toArray();

        // get the popular pages
        $items = Page::where('is_hidden', 0)
            ->whereNotIn('id', $ids)
            ->orderBy('views', 'DESC')
            ->get()
            ->take(5);

        return $items;

        return $items;
    }
}