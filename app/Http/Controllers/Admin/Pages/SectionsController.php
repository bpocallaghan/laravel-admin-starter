<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Models\Page;
use App\Http\Requests;
use App\Models\PageSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class SectionsController extends AdminController
{
    /**
     * Display a listing of content.
     *
     * @param Page $page
     * @return Response
     */
    public function index(Page $page)
    {
        save_resource_url();

        $page->load('sections.component');

        return $this->view('pages.components.components')->with('page', $page);
    }

    /**
     * Remove the specified content from storage.
     *
     * @param Page        $page
     * @param PageSection $section
     * @return Response
     * @internal param $page_section
     */
    public function destroy(Page $page, PageSection $section)
    {
        // delete page_content
        $section->component->delete();
        // delete page_sections
        $this->deleteEntry($section, request());

        log_activity('Page Component Deleted', 'A Page Content was successfully removed from the Page', $section);

        return redirect_to_resource();
    }

    /**
     * @param Page $page
     * @return array
     */
    public function updateOrder(Page $page)
    {
        $items = json_decode(request('list'), true);
        
        foreach ($items as $key => $item) {

            $row = PageSection::find($item['id']);
            if($row) {
                $row->update([
                    'list_order' => ($key + 1)
                ]);
            }
        }

        return ['result' => 'success'];
    }
}