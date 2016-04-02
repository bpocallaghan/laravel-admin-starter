<?php

namespace Titan\Controllers\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha;

trait GoogleCaptcha
{
    // https://www.google.com/recaptcha/admin
    // https://github.com/google/recaptcha (package - google/recaptcha)

    /**
     * Validate Captcha
     * @param $request
     * @return bool
     */
    private function validateCaptcha(Request $request)
    {
        // validate google captcha
        $recaptcha = new ReCaptcha(env('RECAPTCHA_PRIVATE_KEY'));
        $response = $recaptcha->verify(input('g-recaptcha-response'), $request->getClientIp());

        return $response;
    }

    /**
     * Get the captcha json responses
     * @param $response
     * @return JsonResponse
     */
    private function captchaResponse($response)
    {
        $errors = ['g-recaptcha-response' => ['Oops, something went wrong']];
        foreach ($response->getErrorCodes() as $k => $code) {
            if ($code == 'missing-input-response') {
                $code = 'Please confirm you are not a robot.';
            }
            $errors['g-recaptcha-response'][$k] = $code;
        }

        return new JsonResponse($errors, 422);
    }
}