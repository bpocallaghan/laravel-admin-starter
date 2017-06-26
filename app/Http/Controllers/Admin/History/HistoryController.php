<?php

namespace App\Http\Controllers\Admin\History;

use App\Http\Requests;
use App\Models\LogActivity;
use App\Models\LogAdminActivity;
use Titan\Controllers\TitanAdminController;

class HistoryController extends TitanAdminController
{
    public function website()
    {
        $actions = LogActivity::getLatest();

        return $this->view('history.website', compact('actions'));
    }

    public function admin()
    {
        $activities = LogAdminActivity::getLatest();

        return $this->view('history.admin', compact('activities'));
    }
}