<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\Models\UserInvite;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Notifications\UserConfirmedAccount;

class RegisterController extends AuthController
{
    /**
     * Show the application registration form.
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm($token = null)
    {
        $this->showPageBanner = false;

        // check if token is valid
        $userInvite = UserInvite::whereToken($token)->whereNull('claimed_at')->first();

        return $this->view('register')->with('userInvite', $userInvite);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $attributes = request()->validate(User::$rules);

        // create new user
        $user = User::create([
            'firstname'          => $attributes['firstname'],
            'lastname'           => $attributes['lastname'],
            'email'              => $attributes['email'],
            'password'           => bcrypt($attributes['password']),
            'confirmation_token' => 'confirmation_token', // will generate a new unique token
        ]);

        // add user roles
        // send email
        // log activity
        event(new UserRegistered($user, input('token')));

        alert()->success('Thank you,',
            'your account has been created, please check your inbox for further instructions.');

        log_activity('Register', $user->fullname . ' registered.');

        return redirect(route('login'));
    }

    /**
     * User click on register confirmation link in mail
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmAccount($token)
    {
        $user = User::where('confirmation_token', $token)->first();
        if ($user) {
            if ($user->confirmed_at && strlen($user->confirmed_at) > 6) {
                alert()->info('Account is Active',
                    'Your account is already active, please try to sign in.');
            }
            else {
                // confirm / activate user
                $user->confirmation_token = null;
                $user->confirmed_at = Carbon::now();
                $user->update();

                // notify
                $user->notify(new UserConfirmedAccount());

                alert()->success('Success',
                    '<br/>Congratulations, your account has been activated. Please Sign In below.');

                log_activity('User Confirmed', $user->fullname . ' confirmed their account', $user);
            }
        }
        else {
            alert()->error('Whoops!', 'Sorry, the token does not exist.');

            log_activity('User Confirmed', 'INVALID TOKEN');
        }

        return redirect(route('login'));
    }
}
