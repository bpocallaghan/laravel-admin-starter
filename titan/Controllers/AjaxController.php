<?php

namespace Titan\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    protected $clientIp;

    protected $clientAgent;

    function __construct(Request $request)
    {
        $this->clientIp = $request->getClientIp();
        $this->clientAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    }
}