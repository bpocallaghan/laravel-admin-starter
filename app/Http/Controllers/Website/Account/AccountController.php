<?php

namespace App\Http\Controllers\Website\Account;

use App\Http\Requests;
use Illuminate\Http\Request;
use Bpocallaghan\FAQ\Models\FAQ;
use App\Http\Controllers\Website\WebsiteController;

class AccountController extends WebsiteController
{
	public function index()
	{
	    $faq = FAQ::whereHas('category', function($query) {
	        return $query->where('name', 'Account');
        })->orderBy('list_order')->get();

		return $this->view('account.account', compact('faq'));
	}
}