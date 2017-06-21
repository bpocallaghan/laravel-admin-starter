<?php

namespace App\Http\Controllers\Auth;

use App\Models\LogLogin;
use Password;
use App\Http\Requests;
use Illuminate\Http\Request;
use Titan\Controllers\TitanController;

class ForgotPasswordController extends TitanController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        $this->title = 'Forgot Password';

        return $this->view('auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = Password::broker()->sendResetLink($request->only('email'));

        switch ($response) {
            case Password::RESET_LINK_SENT:
                alert()->success('Success!',
                    'Please check your inbox for the email with instructions');

                $this->logAuth($request, 'password-forgot');

                return redirect(route('login'));

            default:
                return redirect()
                    ->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param string                   $status
     */
    private function logAuth(Request $request, $status = '')
    {
        LogLogin::create([
            'username'     => $request->get('email'),
            'status'       => $status,
            'role'         => 'admin',
            'client_ip'    => $request->getClientIp(),
            'client_agent' => $_SERVER['HTTP_USER_AGENT'],
        ]);
    }
}