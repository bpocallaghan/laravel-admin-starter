<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\LogSocialShare;
use Titan\Controllers\AjaxController;

class LogsController extends AjaxController
{
    /**
     * Logs the social media clicks
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function socialMedia(Request $request)
    {
        $row = LogSocialShare::create([
            'type'         => input('type'),
            'title'        => input('title'),
            'description'  => input('description'),
            'url'          => input('url'),
            'image'        => input('image'),
            'client_ip'    => $this->clientIp,
            'client_agent' => $this->clientAgent,
        ]);

        return json_response();
    }
}