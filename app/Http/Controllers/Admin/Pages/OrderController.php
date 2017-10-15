<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Models\Page;
use App\Models\SportType;
use App\Models\NavigationWebsite;
use Illuminate\Http\Request;

use App\Http\Requests;
use Titan\Controllers\TitanAdminController;

class OrderController extends TitanAdminController
{
    private $navigationType = 'main';

    private $defaultParent = 0;

    private $orderProperty = 'header_order';

    private function updateNavType($type = 'all')
    {
        $this->defaultParent = 0;
        $this->navigationType = $type;
        $this->orderProperty = $type . '_order';
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $type
     * @return Response
     */
    public function index($type = 'all')
    {
        $this->updateNavType($type);

        $itemsHtml = $this->getNavigationHtml($this->defaultParent);

        return $this->view('pages.order', compact('itemsHtml'));
    }

    /**
     * Update the order of navigation
     *
     * @param string  $type
     * @param Request $request
     * @return array
     */
    public function updateOrder(Request $request, $type = 'main')
    {
        $this->updateNavType($type);

        $navigation = json_decode($request->get('list'), true);

        foreach ($navigation as $key => $nav) {

            $idd = $this->defaultParent ? $this->defaultParent->id : 0;
            $row = $this->updateNavigationListOrder($nav['id'], ($key + 1), $idd);

            $this->updateIfNavHasChildren($nav);
        }

        return ['result' => 'success'];
    }

    /**
     * Generate the nestable html
     *
     * @param null $parent
     *
     * @return string
     */
    private function getNavigationHtml($parent = null)
    {
        $html = '<ol class="dd-list">';

        $parentId = ($parent ? $parent->id : 0);
        $items = Page::whereParentIdORM($parentId, $this->navigationType,
            $this->orderProperty);

        foreach ($items as $key => $nav) {
            $html .= '<li class="dd-item" data-id="' . $nav->id . '">';
            $html .= '<div class="dd-handle">' . '<i class="fa-fw fa fa-' . $nav->icon . '"></i> ';
            $html .= $nav->title . ' ' . ($nav->is_hidden == 1 ? '(HIDDEN)' : '') . ' <span style="float:right"> ' . $nav->url . ' </span></div>';
            $html .= $this->getNavigationHtml($nav);
            $html .= '</li>';
        }

        $html .= '</ol>';

        return (count($items) >= 1 ? $html : '');
    }

    /**
     * Loop through children and update list order (recursive)
     *
     * @param $nav
     */
    private function updateIfNavHasChildren($nav)
    {
        if (isset($nav['children']) && count($nav['children']) > 0) {
            $children = $nav['children'];
            foreach ($children as $c => $child) {
                $row = $this->updateNavigationListOrder($child['id'], ($c + 1), $nav['id']);

                $this->updateIfNavHasChildren($child);
            }
        }
    }

    /**
     * Update Navigation Item, with new list order and parent id (list and parent can change)
     *
     * @param     $id
     * @param     $listOrder
     * @param int $parentId
     *
     * @return mixed
     */
    private function updateNavigationListOrder($id, $listOrder, $parentId = 0)
    {
        $row = Page::find($id);
        $row->parent_id = $parentId;
        if ($row->url_parent_id != 0) {
            $row->url_parent_id = $parentId; // update the url parent id as well
        }

        //$row->updateUrl();
        $row[$this->orderProperty] = $listOrder;
        $row->save();

        return $row;
    }
}