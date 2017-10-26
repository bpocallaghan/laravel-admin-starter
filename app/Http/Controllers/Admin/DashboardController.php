<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;

class DashboardController extends AdminController
{
	public function index()
	{
		return $this->view('dashboard');
	}
}
