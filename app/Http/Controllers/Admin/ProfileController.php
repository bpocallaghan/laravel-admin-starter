<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class ProfileController extends AdminController
{
    public function index()
    {
        return $this->view('profile');
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
            $this->validate($request, array_except(User::$rulesProfile, 'photo'));
        }
        else {
            $this->validate($request, User::$rulesProfile);

            $photo = $this->uploadProfilePicture($request->file('photo'));

            $request->merge(['image' => $photo]);
        }

        // update user without photo and password
        $this->updateEntry($user, $request->only([
            'firstname',
            'lastname',
            'cellphone',
            'telephone',
            'born_at',
            'image'
        ]));

        // update user  password
        if ($request['password'] && strlen($request['password']) >= 2) {
            user()->update([
                'password' => bcrypt($request['password']),
            ]);
        }

        return redirect('/admin/profile');
    }

    /**
     * Upload the profile picture image
     *
     * @param        $file
     * @return string|void
     */
    private function uploadProfilePicture($file)
    {
        $name = token();
        $extension = $file->guessClientExtension();

        $filename = $name . '.' . $extension;
        $imageTmp = Image::make($file->getRealPath());

        if (!$imageTmp) {
            return notify()->error('Oops', 'Something went wrong', 'warning shake animated');
        }

        $path = upload_path_images();

        // save the image
        $imageTmp->fit(250, 250)->save($path . $filename);

        return $filename;
    }
}