<?php

namespace App\Http\Controllers\Admin\Pages;

use Redirect;
use App\Models\Page;
use App\Http\Requests;
use App\Models\PageDocument;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class PageDocumentsController extends AdminController
{
    /**
     * Show the form for creating a new content.
     *
     * @param Page $page
     * @return Response
     */
    public function create(Page $page)
    {
        $item = PageDocument::create([
            'heading'         => 'Documents Heading',
            'heading_element' => 'h2',
        ]);

        return $this->view('pages.components.documents')
            ->with('page', $page)
            ->with('item', $item);
    }

    /**
     * Show the form for editing the specified content.
     *
     * @param Page        $page
     * @param PageDocument $document
     * @return Response
     */
    public function edit(Page $page, PageDocument $document)
    {
        return $this->view('pages.components.documents')->with('page', $page)->with('item', $document);
    }

    /**
     * Update the specified content in storage.
     *
     * @param Page        $page
     * @param PageDocument $document
     * @return Response
     */
    public function update(Page $page, PageDocument $document)
    {
        $attributes = request()->validate(PageDocument::$rules, PageDocument::$messages);

        unset($attributes['page_id']);
        $item = $this->updateEntry($document, $attributes);

        $page->attachComponent($item);

        return redirect_to_resource();
    }
}
