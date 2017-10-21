<?php

namespace App\Http\Controllers\Admin\Documents;

use Redirect;
use App\Http\Requests;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class CategoriesController extends AdminController
{
    /**
     * Display a listing of document_category.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        return $this->view('documents.categories.index')->with('items', DocumentCategory::all());
    }

    /**
     * Show the form for creating a new document_category.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('documents.categories.create_edit');
    }

    /**
     * Store a newly created document_category in storage.
     *
     * @return Response
     */
    public function store()
    {
        $attributes = request()->validate(DocumentCategory::$rules, DocumentCategory::$messages);

        $category = $this->createEntry(DocumentCategory::class, $attributes);

        return redirect_to_resource();
    }

    /**
     * Show the form for editing the specified document_category.
     *
     * @param DocumentCategory $category
     * @return Response
     */
    public function edit(DocumentCategory $category)
    {
        return $this->view('documents.categories.create_edit')->with('item', $category);
    }

    /**
     * Update the specified document_category in storage.
     *
     * @param DocumentCategory $category
     * @return Response
     */
    public function update(DocumentCategory $category)
    {
        $attributes = request()->validate(DocumentCategory::$rules, DocumentCategory::$messages);

        $category = $this->updateEntry($category, $attributes);

        return redirect_to_resource();
    }

    /**
     * Remove the specified document_category from storage.
     *
     * @param DocumentCategory $category
     * @return Response
     */
    public function destroy(DocumentCategory $category)
    {
        $this->deleteEntry($category, request());

        return redirect_to_resource();
    }
}
