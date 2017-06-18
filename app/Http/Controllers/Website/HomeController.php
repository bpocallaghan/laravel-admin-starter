<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests;

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
