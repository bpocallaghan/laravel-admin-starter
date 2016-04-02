<?php

namespace App\Http\Controllers\Admin;

use App\Models\LogAdminActivity;
use Illuminate\Http\Request;

use App\Http\Requests;
use LaravelAnalytics;
use Titan\Controllers\TitanAdminController;
use Titan\Controllers\Traits\Analytics;

class DashboardController extends TitanAdminController
{
    use Analytics;

    public function index()
    {
        $activities = LogAdminActivity::getLatest();

        return $this->view('dashboard', compact('activities'));
    }
}