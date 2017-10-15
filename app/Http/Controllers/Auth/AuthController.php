<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use App\Models\LogLogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\Website\BaseWebsiteController;

class AuthController extends WebsiteController
{
    protected $baseViewPath = 'auth.';

    /**
     * @param \Illuminate\Http\Request $request
     * @param string                   $status
     */
    protected function logLogin(Request $request, $status = '')
    {
        LogLogin::create([
            'username'     => $request->get('email'),
            'status'       => $status,
            'role'         => 'website_admin',
            'client_ip'    => $request->getClientIp(),
            'client_agent' => $_SERVER['HTTP_USER_AGENT'],
        ]);
    }
}