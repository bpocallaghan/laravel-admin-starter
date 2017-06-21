<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Titan\Controllers\TitanAdminController;

class DashboardController extends AdminController
{
	public function index()
	{
		return $this->view('dashboard');
	}
}
