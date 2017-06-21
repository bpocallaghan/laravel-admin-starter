<?php

namespace App\Http\Controllers\Auth;

use App\Models\LogLogin;
use Password;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Titan\Controllers\TitanController;
use App\Http\Controllers\WebsiteController;

class ResetPasswordController extends TitanController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string|null              $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $this->title = 'Reset Password';

        $email = $request->input('email');

        return $this->view('auth.passwords.reset', compact('token', 'email'));
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $this->validate($request, [
            'token'    => 'required',
            'email'    => 'required|string|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');

        // response
        $response = Password::broker()->reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->password_updated_at = Carbon::now();
            $user->save();
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                alert()->success('Success',
                    'Congratulations, try signing in with your new password');

                $this->logAuth($request, 'password-reset');

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