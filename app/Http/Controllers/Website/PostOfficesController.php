<?php

namespace App\Http\Controllers\Website;

use App\Models\PostOffice;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostOfficesController extends WebsiteController
{
	public function index()
	{
	    $items = PostOffice::with('city')->get()->sortBy(function($item) {
	        return $item->city->title;
        });

		return $this->view('post_offices')->with('postOffices', $items);
	}
}