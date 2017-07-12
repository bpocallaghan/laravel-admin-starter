<?php

namespace App\Http\Controllers\Admin\Blog;

use Redirect;
use App\Http\Requests;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class CategoriesController extends AdminController
{
	/**
	 * Display a listing of article_category.
	 *
	 * @return Response
	 */
	public function index()
	{
		save_resource_url();

		return $this->view('blog.categories.index')->with('items', ArticleCategory::all());
	}

	/**
	 * Show the form for creating a new article_category.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('blog.categories.create_edit');
	}

	/**
	 * Store a newly created article_category in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, ArticleCategory::$rules, ArticleCategory::$messages);

        $this->createEntry(ArticleCategory::class, $request->only('name'));

        return redirect_to_resource();
	}

	/**
	 * Display the specified article_category.
	 *
	 * @param ArticleCategory $category
	 * @return Response
	 */
	public function show(ArticleCategory $category)
	{
		return $this->view('blog.categories.show')->with('item', $category);
	}

	/**
	 * Show the form for editing the specified article_category.
	 *
	 * @param ArticleCategory $category
     * @return Response
     */
    public function edit(ArticleCategory $category)
	{
		return $this->view('blog.categories.create_edit')->with('item', $category);
	}

	/**
	 * Update the specified article_category in storage.
	 *
	 * @param ArticleCategory  $category
     * @param Request    $request
     * @return Response
     */
    public function update(ArticleCategory $category, Request $request)
	{
		$this->validate($request, ArticleCategory::$rules, ArticleCategory::$messages);

        $this->updateEntry($category, $request->only('name'));

        return redirect_to_resource();
	}

	/**
	 * Remove the specified article_category from storage.
	 *
	 * @param ArticleCategory  $category
     * @param Request    $request
	 * @return Response
	 */
	public function destroy(ArticleCategory $category, Request $request)
	{
		$this->deleteEntry($category, $request);

        return redirect_to_resource();
	}
}
