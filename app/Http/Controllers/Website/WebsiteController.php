<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;

use App\Http\Requests;
use Titan\Controllers\TitanWebsiteController;

class WebsiteController extends TitanWebsiteController
{
    protected $showPageBanner = true;

    /**
     * Return / Render the view
     * @param       $view
     * @param array $data
     * @return $this
     */
    protected function view($view, $data = [])
    {
        return parent::view($view, $data)->with('showPageBanner', $this->showPageBanner);
    }
}