<?php

namespace App\Http\Controllers\Auth;

use Password;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\WebsiteController;

class ResetPasswordController extends AuthController
{
    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  string|null $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm($token = null)
    {
        $email = request('email');
        $this->showPageBanner = false;

        return $this->view('reset_password', compact('token', 'email'));
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

                $this->logLogin($request, 'password-reset');

                return redirect(route('login'));

            default:
                return redirect()
                    ->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
        }
    }
}