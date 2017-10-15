<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\User;
use Illuminate\Validation\Rule;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class ClientsController extends AdminController
{
    /**
     * Display a listing of client.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        $items = User::with('roles')->whereRole(Role::$WEBSITE)->get();

        return $this->view('clients.index')->with('items', $items);
    }

    /**
     * Show the form for editing the specified client.
     *
     * @param User $user
     * @return Response
     */
    public function edit($user)
    {
        $user = User::find($user);
        if (!$user) {
            return redirect_to_resource();
        }

        $roles = Role::getAllLists();

        return $this->view('clients.create_edit')->with('item', $user)->with('roles', $roles);
    }

    /**
     * Update the specified client in storage.
     *
     * @param User $user
     * @return Response
     */
    public function update($user)
    {
        $user = User::find($user);
        if (!$user) {
            return redirect_to_resource();
        }

        request()->validate([
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|' . Rule::unique('users')->ignore($user->id),
            'roles'     => 'required|array',
        ]);

        $this->updateEntry($user, request()->only([
            'firstname',
            'lastname',
            'cellphone',
            'telephone',
            'email',
            'born_at'
        ]));

        $user->roles()->sync(input('roles'));

        return redirect_to_resource();
    }

    /**
     * Remove the specified client from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy($user)
    {
        $user = User::find($user);
        if (!$user) {
            return redirect_to_resource();
        }

        $this->deleteEntry($user, request());

        return redirect_to_resource();
    }
}
