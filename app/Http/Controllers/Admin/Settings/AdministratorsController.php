<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Admin\AdminController;
use App\Mail\AdminInvitRegistration;
use App\Models\Role;
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

        $items = User::with('roles')->whereRole(Role::$ADMIN)->get();

        return $this->view('settings.administrators.index', compact('items'));
    }

    /**
     * Show the invites
     *
     * @return mixed
     */
    public function showInvites()
    {
        $items = UserInvite::orderBy('created_at')->get();

        return $this->view('settings.administrators.invite')->with('items', $items);
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
        $row = UserInvite::create([
            'email'      => input('email'),
            'token'      => '-',
            'invited_by' => user()->id,
        ]);

        // send mail to email
        Mail::send(new AdminInvitRegistration($row));

        notify()->success('Success', 'Invitation sent to ' . $row->email,
            'thumbs-up bounce animated');

        return redirect_to_resource();
    }

    /**
     * Show the form for editing the specified faq.
     *
     * @param User $administrator
     * @return Response
     */
    public function edit(User $administrator)
    {
        $roles = Role::getAllLists();

        return $this->view('settings.administrators.create_edit', compact('roles'))
            ->with('item', $administrator);
    }

    /**
     * Update the specified faq in storage.
     * @param User    $administrator
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(User $administrator, Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname'  => 'required',
            'roles'     => 'required|array',
        ]);

        if ($administrator->id <= 3) {
            notify()->warning('Whoops', 'You can not edit this user.');

            return redirect_to_resource();
        }

        $this->updateEntry($administrator, $request->only([
            'firstname',
            'lastname',
            'cellphone',
            'telephone',
            'born_at'
        ]));

        $administrator->roles()->sync(input('roles'));

        return redirect_to_resource();
    }

    /**
     * Remove the specified faq from storage.
     * @param User    $administrator
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $administrator, Request $request)
    {
        if ($administrator->id <= 3) {
            notify()->warning('Whoops', 'You can not delete this user.');
        }
        else {
            $this->deleteEntry($administrator, $request);
        }

        return redirect_to_resource();
    }
}