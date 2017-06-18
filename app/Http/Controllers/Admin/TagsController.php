<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Http\Requests;

use Redirect;
use Titan\Controllers\TitanAdminController;

use Illuminate\Http\Request;

class TagsController extends TitanAdminController
{
    /**
     * Display a listing of tag.
     *
     * @return Response
     */
    public function index()
    {
        session()->put('url', request()->url());

        return $this->view('tags.index')->with('items', Tag::all());
    }

    /**
     * Show the form for creating a new tag.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('tags.add_edit');
    }

    /**
     * Store a newly created tag in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Tag::$rules, Tag::$messages);

        $this->createEntry(Tag::class, $request->all());

        return redirect(session('url'));
    }

    /**
     * Display the specified tag.
     *
     * @param Tag $tag
     * @return Response
     */
    public function show(Tag $tag)
    {
        return $this->view('tags.show')->with('item', $tag);
    }

    /**
     * Show the form for editing the specified tag.
     *
     * @param Tag $tag
     * @return Response
     */
    public function edit(Tag $tag)
    {
        return $this->view('tags.add_edit')->with('item', $tag);
    }

    /**
     * Update the specified tag in storage.
     *
     * @param Tag     $tag
     * @param Request $request
     * @return Response
     */
    public function update(Tag $tag, Request $request)
    {
        $this->validate($request, Tag::$rules, Tag::$messages);

        $this->updateEntry($tag, $request->all());

        return redirect(session('url'));
    }

    /**
     * Remove the specified tag from storage.
     *
     * @param Tag     $tag
     * @param Request $request
     * @return Response
     */
    public function destroy(Tag $tag, Request $request)
    {
        $this->deleteEntry($tag, $request);

        return redirect(session('url'));
    }
}