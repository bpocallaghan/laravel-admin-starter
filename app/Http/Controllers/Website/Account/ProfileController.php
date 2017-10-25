<?php

namespace App\Http\Controllers\Website\Account;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Validation\Rule;

class ProfileController extends WebsiteController
{
    public function index()
    {
        $user = user();

        return $this->view('account.profile', compact('user'));
    }

    /**
     * Update the user's profile info
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $attributes = request()->validate([
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|' . Rule::unique('users')->ignore(user()->id),
            'password'  => 'nullable|min:4|confirmed',
            'cellphone' => 'nullable',
        ]);

        // update user
        user()->update([
            'firstname' => $attributes['firstname'],
            'lastname'  => $attributes['lastname'],
            'email'     => $attributes['email'],
            'cellphone' => $attributes['cellphone'],
        ]);

        // only update when a new password was entered
        $message = '';
        if ($attributes['password'] && strlen($attributes['password']) >= 2) {
            $message = " and <strong>Password</strong> ";
            user()->update([
                'password' => bcrypt($attributes['password']),
            ]);
        }

        alert()->success('Updated!',
            "Your personal information {$message} was successfully updated.");

        return redirect()->back();
    }
}