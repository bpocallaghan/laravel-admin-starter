<?php
namespace Titan\Controllers\Auth;

use App\Models\LogAdminLogin;
use App\Models\LogsAdminLogin;
use App\Models\UserInvite;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Notify;
use NotifyAlert;
use Titan\Controllers\TitanController;

class TitanAuthController extends TitanController
{
    use ThrottlesLogins;

    protected $baseViewPath = 'auth.';

    // for custom error messages
    protected $failedMessage = '';

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $this->title = 'Sign In';

        return $this->view('login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        // make sure the account has been activated
        $row = User::where('email', $credentials[$this->loginUsername()])
            ->whereNotNull('activated_at')
            ->first();

        // account not active
        if (!$row) {
            $this->logAdminLogin($request, 'inactive');

            $this->failedMessage = 'Please activate your account before trying to login.';
        }

        if ($row && Auth::guard($this->getGuard())
                ->attempt($credentials, $request->has('remember'))
        ) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        if ($row) {
            $this->logAdminLogin($request, 'invalid');
        }

        return $this->sendFailedLoginResponse($request);

        // attempt to login
        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            // get the logged in user
            $user = user();

            // notify message
            if ($user->getAttribute('logged_in_at')) {
                \Notify::info('Info',
                    'Last time you logged in was ' . $user->getAttribute('logged_in_at')
                        ->diffForHumans(), 'clock-o rotateIn animated', 8000);
            }
            else {
                \Notify::info('Welcome', 'Hi ' . $user->fullname . '. Please enjoy your time here.',
                    'bell swing animated', 8000);
            }

            // log
            $this->logAdminLogin($request, 'success');

            // update logged_in_at
            $user->update(['logged_in_at' => Carbon::now()]);

            return redirect()->intended($this->redirectPath);
        }

        alert()->error('Whoops!', 'Invalid credentials provided');

        $this->logAdminLogin($request, 'invalid');

        return $this->getRedirectLogin($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required',
            'password'             => 'required',
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  bool                     $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        $user = user();

        // notify message
        if ($user->getAttribute('logged_in_at')) {
            \Notify::info('Info',
                'Last time you logged in was ' . $user->getAttribute('logged_in_at')
                    ->diffForHumans(), 'clock-o rotateIn animated', 8000);
        }
        else {
            \Notify::info('Welcome',
                'Hi ' . $user->getAttribute('fullname') . '. Welcome to ' . env('APP_TITLE'),
                'bell swing animated', 8000);
        }

        // log
        $this->logAdminLogin($request, 'success');

        // update logged_in_at
        user()->update(['logged_in_at' => Carbon::now()]);

        return redirect()->intended($this->redirectPath);
    }

    /**
     * Show the application registration form.
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm($token)
    {
        // check if token is valid
        $row = UserInvite::whereToken($token)->whereNull('claimed_at')->first();
        if (!$row) {
            alert()->error('Whoops!', 'The token is not valid for registration');

            return redirect($this->loginPath);
        }

        $this->title = 'Register';

        return $this->view('register')->with('token', $token)->with('email', $row->email);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname'  => 'required',
            'gender'    => 'required|in:male,female',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:4|confirmed',
            'token'     => 'required|exists:user_invites,token',
        ]);

        // create new user
        $user = User::create([
            'firstname'          => input('firstname'),
            'lastname'           => input('lastname'),
            'gender'             => input('gender'),
            'email'              => input('email'),
            'password'           => bcrypt(input('password')),
            'confirmation_token' => null,
        ]);

        // set invite claimed
        UserInvite::where('token', input('token'))->update(['claimed_at' => Carbon::now()]);

        // send the confirmation mail
        \Mail::send('admin.emails.auth.register_confirm',
            ['name' => $user->fullname, 'token' => $user->confirmation_token],
            function ($message) use ($user) {
                $message->to($user->email, $user->fullname)->subject('Confirm Registration');
            });

        alert()->success('Success',
            'Thank you, your account has been created, please check your inbox to active your account before you can log in');

        return redirect($this->loginPath);
    }

    /**
     * User click on register confirmation link in mail
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmRegister($token)
    {
        $user = User::where('confirmation_token', $token)->first();
        if ($user) {
            if ($user->activated_at && strlen($user->activated_at) > 6) {
                alert()->info('Account is Active',
                    'Your account is already active, try to sign in');
            }
            else {
                $user->activated_at = Carbon::now();
                $user->update();

                alert()->success('Success', 'Congratulations, your account has been activated');
            }
        }
        else {
            alert()->error('Whoops!', 'Sorry, the token does not exist');
        }

        return redirect($this->loginPath);
    }

    private function getRedirectLogin(Request $request)
    {
        return redirect($this->loginPath)->withInput($request->only('email', 'remember'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $message
     */
    private function logAdminLogin(Request $request, $message)
    {
        LogAdminLogin::create([
            'email'        => $request->get('email'),
            'message'      => $message,
            'client_ip'    => $request->getClientIp(),
            'client_agent' => $_SERVER['HTTP_USER_AGENT'],
        ]);
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()
            ->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return strlen($this->failedMessage) > 5 ? $this->failedMessage : 'These credentials do not match our records.';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        return $this->logout();
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard($this->getGuard())->logout();

        return redirect(property_exists($this,
            'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Get the guest middleware for the application.
     */
    public function guestMiddleware()
    {
        $guard = $this->getGuard();

        return $guard ? 'guest:' . $guard : 'guest';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }

    /**
     * Determine if the class is using the ThrottlesLogins trait.
     *
     * @return bool
     */
    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(ThrottlesLogins::class, class_uses_recursive(get_class($this)));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}