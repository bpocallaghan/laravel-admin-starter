<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Requests;
use Titan\Controllers\TitanWebsiteController;

class WebsiteController extends TitanWebsiteController
{
    protected $showPageBanner = false;

    /**
     * Return / Render the view
     * @param       $view
     * @param array $data
     * @return $this
     */
    protected function view($view, $data = [])
    {
        $banners = $this->getBanners();

        return parent::view($view, $data)
            ->with('showPageBanner', $this->showPageBanner)
            ->with('banners', $banners);
    }

    protected function getBanners()
    {
        $items = Banner::active()->get();

        return $items;
    }
}