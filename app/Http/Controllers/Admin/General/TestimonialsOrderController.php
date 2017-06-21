<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialsOrderController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $html = $this->getOrderHtml();

        return $this->view('testimonials.order')->with('itemsHtml', $html);
    }

    /**
     * Update the order
     * @param Request $request
     * @return array
     */
    public function updateOrder(Request $request)
    {
        $navigation = json_decode($request->get('list'), true);

        foreach ($navigation as $key => $nav) {
            $row = $this->updateListOrder($nav['id'], ($key + 1));
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
    private function getOrderHtml($parent = null)
    {
        $html = '<ol class="dd-list">';

        $items = Testimonial::orderBy('list_order')->get();
        foreach ($items as $key => $item) {
            $html .= '<li class="dd-item" data-id="' . $item->id . '">';
            $html .= '<div class="dd-handle">';
            $html .= $item->customer . ' ' . ' <span style="float:right"> ' . substr(strip_tags($item->description), 0, 40) . '... </span></div>';
            $html .= '</li>';
        }

        $html .= '</ol>';

        return (count($items) >= 1 ? $html : '');
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
    private function updateListOrder($id, $listOrder, $parentId = 0)
    {
        $row = Testimonial::find($id);
        $row->list_order = $listOrder;
        $row->save();

        return $row;
    }
}