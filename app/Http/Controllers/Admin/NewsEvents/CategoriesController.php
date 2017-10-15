<?php

namespace App\Http\Controllers\Admin\NewsEvents;

use Redirect;
use App\Http\Requests;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class CategoriesController extends AdminController
{
	/**
	 * Display a listing of news_category.
	 *
	 * @return Response
	 */
	public function index()
	{
		save_resource_url();

		return $this->view('news_events.categories.index')->with('items', NewsCategory::all());
	}

	/**
	 * Show the form for creating a new news_category.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('news_events.categories.create_edit');
	}

	/**
	 * Store a newly created news_category in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$attributes = request()->validate(NewsCategory::$rules, NewsCategory::$messages);

        $category = $this->createEntry(NewsCategory::class, $attributes);

        return redirect_to_resource();
	}

	/**
	 * Display the specified news_category.
	 *
	 * @param NewsCategory $category
	 * @return Response
	 */
	public function show(NewsCategory $category)
	{
		return $this->view('news_events.categories.show')->with('item', $category);
	}

	/**
	 * Show the form for editing the specified news_category.
	 *
	 * @param NewsCategory $category
     * @return Response
     */
    public function edit(NewsCategory $category)
	{
		return $this->view('news_events.categories.create_edit')->with('item', $category);
	}

	/**
	 * Update the specified news_category in storage.
	 *
	 * @param NewsCategory  $category
     * @param Request    $request
     * @return Response
     */
    public function update(NewsCategory $category, Request $request)
	{
		$attributes = request()->validate(NewsCategory::$rules, NewsCategory::$messages);

        $category = $this->updateEntry($category, $attributes);

        return redirect_to_resource();
	}

	/**
	 * Remove the specified news_category from storage.
	 *
	 * @param NewsCategory  $category
     * @param Request    $request
	 * @return Response
	 */
	public function destroy(NewsCategory $category, Request $request)
	{
		$this->deleteEntry($category, $request);

        return redirect_to_resource();
	}
}
