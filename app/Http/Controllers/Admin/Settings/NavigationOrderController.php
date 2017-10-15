<?php
namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Models\NavigationAdmin;
use Titan\Controllers\TitanAdminController;

class NavigationOrderController extends TitanAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $html = $this->getNavigationHtml();

        return $this->view('settings.navigation.order')->with('itemsHtml', $html);
    }

    public function updateOrder(Request $request)
    {
        $navigation = json_decode($request->get('list'), true);

        foreach ($navigation as $key => $nav) {
            $row = $this->updateNavigationListOrder($nav['id'], ($key + 1));

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

        if (!(isset($parent) && $parent)) {
            $items = NavigationAdmin::whereParentIdORM(0, true);
        }
        else {
            $items = NavigationAdmin::whereParentIdORM($parent->id, true);
        }

        foreach ($items as $key => $nav) {
            $html .= '<li class="dd-item" data-id="' . $nav->id . '">';
            $html .= '<div class="dd-handle">' . (strlen($nav->icon) > 1 ? '<i class="fa-fw fa fa-' . $nav->icon . '"></i> ' : '');
            $html .= $nav->title . ' ' . ($nav->is_hidden == 1? '(HIDDEN)':'') . ' <span style="float:right"> ' . $nav->url . ' </span></div>';
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
        $row = NavigationAdmin::find($id);
        $row->list_order = $listOrder;
        $row->parent_id = $parentId;
        $row->url_parent_id = $parentId; // update the url parent id as well
        $row->updateUrl();
        $row->save();

        return $row;
    }
}
