<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests;
use Titan\Controllers\WebsiteController;

class HomeController extends WebsiteController
{
    /**
     * Show the home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->view('home');
    }
}
