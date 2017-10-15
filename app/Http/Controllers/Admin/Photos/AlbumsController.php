<?php

namespace App\Http\Controllers\Admin\Photos;

use Redirect;
use App\Http\Requests;
use App\Models\PhotoAlbum;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class AlbumsController extends AdminController
{
    /**
     * Display a listing of photo_album.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        $items = PhotoAlbum::with('photos')->get();

        return $this->view('photos.albums.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new photo_album.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('photos.albums.create_edit');
    }

    /**
     * Store a newly created photo_album in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate(PhotoAlbum::$rules, PhotoAlbum::$messages);

        $album = $this->createEntry(PhotoAlbum::class, $attributes);

        return redirect_to_resource();
    }

    /**
     * Show the form for editing the specified photo_album.
     *
     * @param PhotoAlbum $album
     * @return Response
     */
    public function edit(PhotoAlbum $album)
    {
        return $this->view('photos.albums.create_edit')->with('item', $album);
    }

    /**
     * Update the specified photo_album in storage.
     *
     * @param PhotoAlbum $album
     * @param Request    $request
     * @return Response
     */
    public function update(PhotoAlbum $album, Request $request)
    {
        $attributes = request()->validate(PhotoAlbum::$rules, PhotoAlbum::$messages);

        $album = $this->updateEntry($album, $attributes);

        return redirect_to_resource();
    }

    /**
     * Remove the specified photo_album from storage.
     *
     * @param PhotoAlbum $album
     * @param Request    $request
     * @return Response
     */
    public function destroy(PhotoAlbum $album, Request $request)
    {
        $this->deleteEntry($album, $request);

        return redirect_to_resource();
    }
}
