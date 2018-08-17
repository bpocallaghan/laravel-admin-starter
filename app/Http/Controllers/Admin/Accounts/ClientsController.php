<?php

namespace App\Http\Controllers\Admin\Accounts;

use Illuminate\Validation\Rule;
use Password;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Admin\AdminController;

class ClientsController extends AdminController
{
    /**
     * Display a listing of client.
     *
     * @return Response
     * @throws \Throwable
     */
    public function index()
    {
        // flush filters if not ajax
        if (!request()->ajax()) {
            session()->forget('filtered');
            session()->forget('filter_fullname');
            session()->forget('filter_email');
            session()->forget('filter_cellphone');
        }

        // paginator
        $paginator = $this->getPaginator();

        // if pagination ajax
        if (request()->ajax()) {
            return response()->json(view('admin.accounts.clients.pagination')
                ->with('paginator', $paginator)
                ->render());
        }

        save_resource_url();

        return $this->view("accounts.clients.index")->with('paginator', $paginator);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter()
    {
        session()->put('filtered', true);
        session()->put('filter_fullname', input('name'));
        session()->put('filter_email', input('email'));
        session()->put('filter_cellphone', input('cellphone'));

        return json_response();
    }

    /**
     * @param User $user
     * @return $this
     */
    public function show(User $user)
    {
        return $this->view("accounts.clients.show", compact('user'));
    }

    /**
     * @param User $user
     * @return $this
     */
    public function edit(User $user)
    {
        $item = $user;
        $roles = Role::getAllLists();

        return $this->view('accounts.clients.create_edit')
            ->with('item', $user)
            ->with('roles', $roles);
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

        $attributes = request()->validate([
            'firstname' => 'required',
            'lastname'  => 'required',
            'cellphone' => 'required',
            'telephone' => 'nullable',
            'born_at'   => 'nullable',
            'etokens'   => 'nullable',
            'email'     => 'required|email|' . Rule::unique('users')->ignore($user->id),
            'roles'     => 'required|array',
        ]);

        unset($attributes['roles']);

        $this->updateEntry($user, $attributes);

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

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        //We will send the password reset link to this user. Once we have attempted
        //to send the link, we will examine the response then see the message we
        //need to show to the user. Finally, we'll send out a proper response.
        $response = Password::broker()->sendResetLink($request->only('email'));

        if ($response == 'passwords.sent') {
            notify()->success('Success!', 'Password email sent to client.');
        }
        else {
            notify()->error('Oops', 'Something went wrong', 'warning shake animated');
        }

        return redirect()->back();
    }

    /**
     * Fetch the client paginator
     * @return LengthAwarePaginator
     */
    private function getPaginator()
    {
        $perPage = 40;
        $page = input('page', 1);
        $itemsObj = $this->fetchEntries();
        $items = $itemsObj['items'];
        $total = $itemsObj['total'];
        $baseUrl = config('app.url') . "/admin/accounts/clients";

        // paginator
        $paginator = new LengthAwarePaginator($items->forPage($page, $perPage), count($items),
            $perPage, $page, ['path' => $baseUrl, 'originalEntries' => $total]);

        return $paginator;
    }

    /**
     * Fetch the users
     */
    private function fetchEntries()
    {
        // query to get the products
        //$items = User::orderBy('firstname')->get();
        $items = User::whereRole(Role::$USER)->orderBy('firstname')->get();

        $total = $items->count();
        // if filtered
        if (session('filtered')) {
            // filter entries on the filter criteria
            $client = session('filter_fullname', '');
            if (strlen($client) >= 2) {
                $items = $items->filter(function ($item) use ($client) {
                    return (stristr($item->fullname, $client) !== false);
                });
            }

            $cellphone = session('filter_cellphone', '');
            if (strlen($cellphone) >= 2) {
                $items = $items->filter(function ($item) use ($cellphone) {
                    return (stristr($item->cellphone, $cellphone) !== false);
                });
            }

            $email = session('filter_email', '');
            if (strlen($email) >= 2) {
                $items = $items->filter(function ($item) use ($email) {
                    return (stristr($item->email, $email) !== false);
                });
            }
        }

        return ['items' => $items, 'total' => $total];
    }
}
