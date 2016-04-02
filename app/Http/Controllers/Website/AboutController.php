<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;

use App\Http\Requests;
use Titan\Controllers\WebsiteController;

class AboutController extends WebsiteController
{
	public function index()
	{
        return $this->view('about');
	}
}