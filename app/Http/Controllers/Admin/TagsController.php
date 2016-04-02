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

        return Redirect::route('admin.tags.index');
	}

	/**
	 * Display the specified tag.
	 *
	 * @param Tag $tags
	 * @return Response
	 */
	public function show(Tag $tags)
	{
		return $this->view('tags.show')->with('item', $tags);
	}

	/**
	 * Show the form for editing the specified tag.
	 *
	 * @param Tag $tags
     * @return Response
     */
    public function edit(Tag $tags)
	{
		return $this->view('tags.add_edit')->with('item', $tags);
	}

	/**
	 * Update the specified tag in storage.
	 *
	 * @param Tag  $tags
     * @param Request    $request
     * @return Response
     */
    public function update(Tag $tags, Request $request)
	{
		$this->validate($request, Tag::$rules, Tag::$messages);

        $this->updateEntry($tags, $request->all());

        return Redirect::route('admin.tags.index');
	}

	/**
	 * Remove the specified tag from storage.
	 *
	 * @param Tag  $tags
     * @param Request    $request
	 * @return Response
	 */
	public function destroy(Tag $tags, Request $request)
	{
		$this->deleteEntry($tags, $request);

        return Redirect::route('admin.tags.index');
	}
}