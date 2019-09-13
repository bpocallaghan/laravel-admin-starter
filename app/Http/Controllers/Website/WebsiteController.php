<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests;
use Bpocallaghan\Titan\Models\Page;
use Bpocallaghan\Titan\Models\Banner;

class WebsiteController extends TitanWebsiteController
{
    protected $showPageBanner = true;

    protected $navigationLeft = [];

    protected $navigationRight = [];

    protected $footerNavigation = [];

    protected $navigationFeatured = [];

    protected $popularPages = [];

    protected $activePageTiers = [];

    function __construct()
    {
        parent::__construct();

        // as soon as controller is ready -  get the navigation
        $this->middleware(function ($request, $next) {
            $this->navigationFeatured = Page::getFeatured();
            //$this->navigationLeft = Page::getHeaderNavigationLeft();
            //$this->navigationRight = Page::getHeaderNavigationRight();
            $this->footerNavigation = Page::getFooterNavigationRight();
            $this->popularPages = Page::getPopularPages();
            $this->activePageTiers = $this->findActivePageTiers();

            return $next($request);
        });
    }

    /**
     * Return / Render the view
     * @param       $view
     * @param array $data
     * @return $this
     */
    protected function view($view, $data = [])
    {
        return parent::view($view, $data)
            ->with('settings', settings())
            ->with('banners', $this->getBanners())
            ->with('popularPages', $this->popularPages)
            ->with('showPageBanner', $this->showPageBanner)
            ->with('activePageTiers', $this->activePageTiers)
            ->with('footerNavigation', $this->footerNavigation)
            ->with('navigationFeatured', $this->navigationFeatured);
    }

    protected function getBanners()
    {
        $items = $this->page->banners;

        // if no banners linked to page - get default
        if ($items->count() <= 0) {
            $items = Banner::active()
                ->where('is_website', 1)
                ->orderBy('list_order')
                ->get();
        }

        return $items;
    }

    /**
     * Get the active page tiers and the parent
     * @return object
     */
    private function findActivePageTiers()
    {
        // if selected page has a parent
        // find all pages with same parent id
        // if more than 1 - valid
        // if less than 1 - return 'about us'

        $name = 'About Us';
        $items = collect();
        if ($this->page->parent_id > 0) {
            $rows = Page::where('parent_id', $this->page->parent_id)
                ->orderBy('header_order')
                ->get();

            if ($items->count() > 1) {
                $items = $rows;
                $name = $this->page->parent->name;
            }
        }

        return (object) [
            'name'  => $name,
            'items' => $items,
        ];
    }
}