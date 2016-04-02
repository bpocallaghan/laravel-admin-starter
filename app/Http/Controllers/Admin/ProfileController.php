<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Redirect;
use Titan\Controllers\TitanAdminController;
use Titan\Controllers\Traits\UploadFile;

class ProfileController extends TitanAdminController
{
    use UploadFile;

    /**
     * Show the profile page
     * @return $this
     */
    public function index()
    {
        return $this->view('profile.index');
    }

    /**
     * Update the specified banner in storage.
     *
     * @param User    $user
     * @param Request $request
     * @return Response
     */
    public function update(User $user, Request $request)
    {
        // user we want to edit and session user must be the same
        if ($user->id != user()->id) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors(['firstname' => 'Unauthorized access']);
        }

        // submit without a file
        if (is_null($request->file('photo'))) {
            $this->validate($request, array_except(User::$rules, 'photo'));
        }
        else {
            $this->validate($request, User::$rules);

            $photo = $this->uploadProfilePicture($request->file('photo'));
            $request->merge(['image' => $photo]);
        }

        // update user without photo and password
        $this->updateEntry($user, $request->except(['photo', 'password']));

        return Redirect::to('admin/profile');
    }
}