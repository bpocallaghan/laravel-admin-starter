<?php

namespace App\Http\Controllers\Admin\Settings\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\UserInvite;
use App\User;
use App\Models\UsersInvite;
use Illuminate\Http\Request;
use Mail;
use Titan\Controllers\TitanAdminController;

class AdministratorsController extends AdminController
{
    /**
     * Show all the administrators
     *
     * @return mixed
     */
    public function index()
    {
        save_resource_url();

        $items = User::all();

        $this->resource = 'Administrator';

        return $this->view('settings.admin.users.administrators', compact('items'));
    }

    /**
     * Show the invites
     *
     * @return mixed
     */
    public function showInvites()
    {
        return $this->view('settings.admin.users.invite')->with('invited', UserInvite::all());
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function postInvite(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users|unique:user_invites'
        ]);

        // create row
        $row = UserInvite::create($request->only('token', 'email', 'invited_by'));

        // send the invitation mail
        Mail::send('emails.admin.auth.invite', ['userInvite' => $row],
            function ($message) use ($row) {
                $message->to($row->email, $row->email)->subject('Invited as Administrator at ' . config('app.name'));
            });

        notify()->success('Success', 'Invitation sent to ' . $row->email,
            'thumbs-up bounce animated');

        return redirect_to_resource();
    }
}