<?php

namespace App\Http\Controllers\Admin\Pages;

use Redirect;
use App\Models\Page;
use App\Http\Requests;
use App\Models\Content;
use App\Models\PageContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class PageContentController extends AdminController
{
    /**
     * Show the form for creating a new content.
     *
     * @param Page $page
     * @return Response
     */
    public function create(Page $page)
    {
        return $this->view('pages.components.content')->with('page', $page);
    }

    /**
     * Store a newly created content in storage.
     *
     * @param Page $page
     * @return Response
     */
    public function store(Page $page)
    {
        $attributes = request()->validate(PageContent::$rules, PageContent::$messages);

        unset($attributes['page_id']);
        $item = $this->createEntry(PageContent::class, $attributes);
        $page->attachComponent($item);

        return redirect_to_resource();
    }

    /**
     * Show the form for editing the specified content.
     *
     * @param Page        $page
     * @param PageContent $content
     * @return Response
     */
    public function edit(Page $page, PageContent $content)
    {
        return $this->view('pages.components.content')->with('page', $page)->with('item', $content);
    }

    /**
     * Update the specified content in storage.
     *
     * @param Page        $page
     * @param PageContent $content
     * @return Response
     */
    public function update(Page $page, PageContent $content)
    {
        $attributes = request()->validate(PageContent::$rules, PageContent::$messages);

        unset($attributes['page_id']);
        $content = $this->updateEntry($content, $attributes);

        return redirect_to_resource();
    }
}
