<?php
namespace Titan\Controllers\Auth;

use Password;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use App\Models\PasswordReset;
use Titan\Controllers\TitanController;

class TitanPasswordController extends TitanController
{
    protected $baseViewPath = 'auth.';

    /**
     * Display the form to request a password reset link.
     *
     * @return Response
     */
    public function getEmail()
    {
        $this->title = 'Forgot Password';

        return $this->view('passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  Request $request
     * @return Response
     */
    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $broker = $this->getBroker();

        $response = Password::broker($broker)
            ->sendResetLink($request->only('email'), function (Message $message) {
                $message->subject($this->getEmailSubject());
            });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                alert()->success('Success!',
                    'Please check your inbox for the email with instructions');

                return redirect($this->loginPath);

            case Password::INVALID_USER:
                return redirect()
                    ->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
        }
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : 'Your Password Reset Link';
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param Request $request
     * @param  string $token
     * @return Response
     */
    public function showResetForm(Request $request, $token = null)
    {
        if (is_null($token)) {
            return $this->getEmail();
        }

        $email = $request->input('email');

        $this->title = 'Reset Password';

        return $this->view('passwords.reset', compact('token', 'email'));
    }

    /**
     * Reset the given user's password.
     *
     * @param  Request $request
     * @return Response
     */
    public function reset(Request $request)
    {
        $this->validate($request, [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:4',
        ]);

        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');

        $broker = $this->getBroker();

        $response = Password::broker($broker)->reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();

            // do not login (want to login to update the logs, etc maybe move login to a command / helper function
            // Auth::login($user);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                alert()->success('Success',
                    'Congratulations, try signing in with your new password');

                return redirect($this->loginPath);

            default:
                return redirect()
                    ->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
        }
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return string|null
     */
    public function getBroker()
    {
        return property_exists($this, 'broker') ? $this->broker : null;
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}