<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\Models\UserInvite;
use Illuminate\Http\Request;
use Titan\Controllers\TitanController;

class RegisterController extends TitanController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm($token)
    {
        $this->title = 'Register';

        // check if token is valid
        $row = UserInvite::whereToken($token)->whereNull('claimed_at')->first();
        if (!$row) {
            alert()->error('Whoops!', 'The token is not valid for registration');

            return redirect(route('login'));
        }

        return $this->view('auth.register')->with('token', $token)->with('email', $row->email);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validate($request, User::$rules, []);

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
        \Mail::send('emails.admin.auth.register_confirm',
            ['name' => $user->fullname, 'token' => $user->confirmation_token],
            function ($message) use ($user) {
                $message->to($user->email, $user->fullname)->subject('Confirm Registration');
            });

        alert()->success('Thank you,',
            'your account has been created, please check your inbox for further instructions.');

        log_action('User Registered',
            $user->fullname . ' registered on ' . Carbon::now()->format('d M Y'), $user);

        return redirect(route('login'));
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
            if ($user->confirmed_at && strlen($user->confirmed_at) > 6) {
                alert()->info('Account is Active',
                    'Your account is already active, try to sign in');
            }
            else {
                $user->confirmed_at = Carbon::now();
                $user->update();

                alert()->success('Success', 'Congratulations, your account has been activated');

                log_action('User Confirmed',
                    $user->fullname . ' confirmed account ' . Carbon::now()->format('d M Y'),
                    $user);
            }
        }
        else {
            alert()->error('Whoops!', 'Sorry, the token does not exist');

            log_action('User Confirmed', 'INVALID TOKEN');
        }

        return redirect(route('login'));
    }
}
