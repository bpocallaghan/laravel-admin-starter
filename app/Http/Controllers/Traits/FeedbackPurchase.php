<?php

namespace App\Http\Controllers\Traits;

use App\Events\PurchaseFeedback;
use Illuminate\Http\Request;
use App\Models\FeedbackPurchase as FeedbackPurchaseModel;

trait FeedbackPurchase
{
    /**
     * Purchase Feedback Form
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function feedbackPurchase(Request $request)
    {
        // validate basic model
        $this->validate($request, FeedbackPurchaseModel::$rules);

        // validate google captcha
        $response = $this->validateCaptcha($request);
        if ($response->isSuccess()) {

            $row = FeedbackPurchaseModel::create([
                'type'         => input('type'),
                'firstname'    => input('firstname'),
                'lastname'     => input('lastname'),
                'phone'        => input('phone'),
                'email'        => input('email'),
                'size'         => input('size'),
                'material'     => input('material'),
                'client_ip'    => $request->getClientIp(),
                'client_agent' => $request->header('User-Agent'),
            ]);

            event(new PurchaseFeedback($row, 'Purchase ' . ucfirst(input('type'))));

            return json_response('success');
        }

        return $this->captchaResponse($response);
    }
}