<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\FeedbackContactUs;
use App\Events\ContactUsFeedback;
use Titan\Controllers\Traits\GoogleCaptcha;

class ContactUsController extends WebsiteController
{
    use GoogleCaptcha;

    public function index()
    {
        return $this->view('contact');
    }

    public function feedback(Request $request)
    {
        // validate basic model
        $this->validate($request, FeedbackContactUs::$rules);

        // validate google captcha
        $response = $this->validateCaptcha($request);
        if ($response->isSuccess()) {

            $row = FeedbackContactUs::create([
                'firstname'    => input('firstname'),
                'lastname'     => input('lastname'),
                'phone'        => input('phone'),
                'email'        => input('email'),
                'content'      => input('content'),
                'client_ip'    => $request->getClientIp(),
                'client_agent' => $request->header('User-Agent'),
            ]);

            event(new ContactUsFeedback($row));

            return json_response('success');
        }

        return $this->captchaResponse($response);
    }
}