<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Carbon\Carbon;
use App\Models\LogLogin;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends AuthController
{
    use ThrottlesLogins;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $this->showPageBanner = false;
        return $this->view('login');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string|email|max:240',
            'password'        => 'required|string|min:4|max:240',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // make sure the account has been activated
        if (!User::where($this->username(), input($this->username()))
            ->whereNotNull('confirmed_at')
            ->first()) {
            $this->logLogin($request, 'inactive');

            return $this->sendFailedLoginResponse($request,
                'Please activate your account before trying to login.');
        }

        // try to login
        if (Auth::attempt($request->only([$this->username(), 'password']),
            input('remember', false))) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        $this->logLogin($request, 'invalid');

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    private function sendLoginResponse(Request $request)
    {
        $user = user();

        // notify message
        if ($user->getAttribute('logged_in_at')) {
            notify()->info('Info',
                'Last time you logged in was ' . $user->logged_in_at->diffForHumans(),
                'clock-o rotateIn animated', 8000);
        }
        else {
            notify()->info('Welcome',
                'Hi ' . $user->fullname . '. Welcome to ' . config('app.name'),
                'bell swing animated', 8000);
        }

        // log
        $this->logLogin($request, 'success');

        // update logged_in_at
        $user->update(['logged_in_at' => Carbon::now()]);

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        log_activity('Login', $user->fullname . ' logged in.');

        // if admin - go to admin - else website
        $url = $user->hasRole('admin') ? "/admin" : "/";

        // if ajax (can be from a login modal)
        if (request()->ajax()) {
            return json_response(['redirect' => config('app.url') . $url]);
        }

        return redirect()->intended($url);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    private function username()
    {
        return 'email';
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @param string                    $message
     * @return \Illuminate\Http\RedirectResponse
     */
    private function sendFailedLoginResponse(Request $request, $message = '')
    {
        $errors = [$this->username() => strlen($message) > 2 ? $message : trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()
            ->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
}
