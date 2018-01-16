<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Http\Requests;
use Illuminate\Http\Request;

class BannersOrderController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = Banner::active()->orderBy('list_order')->get();

        return $this->view('banners.order')->with('items', $items);
    }

    /**
     * Update the order
     * @param Request $request
     * @return array
     */
    public function update(Request $request)
    {
        $items = json_decode($request->get('list'), true);

        foreach ($items as $key => $item) {
            Banner::find($item['id'])->update(['list_order' => ($key + 1)]);
        }

        return ['result' => 'success'];
    }
}