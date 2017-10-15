<?php

namespace App\Http\Controllers\Admin\Pages;

use Redirect;
use App\Models\Page;
use App\Http\Requests;
use App\Models\PageGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class PageGalleryController extends AdminController
{
    /**
     * Show the form for creating a new content.
     *
     * @param Page $page
     * @return Response
     */
    public function create(Page $page)
    {
        // on create load - already create the component
        // for the photos to be attached to
        // on submit - it will be linked to the page only
        $item = PageGallery::create([
            'heading'         => 'Gallery Heading',
            'heading_element' => 'h2',
        ]);

        return $this->view('pages.components.gallery')->with('page', $page)->with('item', $item);
    }

    /**
     * Show the form for editing the specified content.
     *
     * @param Page        $page
     * @param PageGallery $gallery
     * @return Response
     */
    public function edit(Page $page, PageGallery $gallery)
    {
        return $this->view('pages.components.gallery')->with('page', $page)->with('item', $gallery);
    }

    /**
     * Update the specified content in storage.
     *
     * @param Page        $page
     * @param PageGallery $gallery
     * @return Response
     */
    public function update(Page $page, PageGallery $gallery)
    {
        $attributes = request()->validate(PageGallery::$rules, PageGallery::$messages);

        unset($attributes['page_id']);
        $item = $this->updateEntry($gallery, $attributes);

        $page->attachComponent($item);

        return redirect_to_resource();
    }
}
