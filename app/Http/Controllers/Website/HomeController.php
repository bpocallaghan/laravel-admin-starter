<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests;
use Bpocallaghan\Titan\Models\News;

class HomeController extends WebsiteController
{
    /**
     * Show the home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$items = News::isActive()->hasPhotos()->orderBy('created_at', 'DESC')->get()->take(6);

        return $this->view('home')->with('hidePageFooter', true); //->with('news', $items)
    }
}
