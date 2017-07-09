<?php

namespace App\Http\Controllers\Admin\Faq;

use App\Models\FaqCategory;
use Redirect;
use App\Http\Requests;
use App\Models\FAQ;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class FaqsController extends AdminController
{
    /**
     * Display a listing of faq.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();
        $items = FAQ::with('category')->get();

        return $this->view('faq.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new faq.
     *
     * @return Response
     */
    public function create()
    {
        $categories = FaqCategory::getAllList();

        return $this->view('faq.create_edit', compact('categories'));
    }

    /**
     * Store a newly created faq in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, FAQ::$rules, FAQ::$messages);

        $this->createEntry(FAQ::class, $request->only('question', 'answer', 'category_id'));

        return redirect_to_resource();
    }

    /**
     * Display the specified faq.
     *
     * @param FAQ $faq
     * @return Response
     */
    public function show(FAQ $faq)
    {
        return $this->view('faq.show')->with('item', $faq);
    }

    /**
     * Show the form for editing the specified faq.
     *
     * @param FAQ $faq
     * @return Response
     */
    public function edit(FAQ $faq)
    {
        $categories = FaqCategory::getAllList();

        return $this->view('faq.create_edit', compact('categories'))->with('item', $faq);
    }

    /**
     * Update the specified faq in storage.
     *
     * @param FAQ     $faq
     * @param Request $request
     * @return Response
     */
    public function update(FAQ $faq, Request $request)
    {
        $this->validate($request, FAQ::$rules, FAQ::$messages);

        $this->updateEntry($faq, $request->only('question', 'answer', 'category_id'));

        return redirect_to_resource();
    }

    /**
     * Remove the specified faq from storage.
     *
     * @param FAQ     $faq
     * @param Request $request
     * @return Response
     */
    public function destroy(FAQ $faq, Request $request)
    {
        $this->deleteEntry($faq, $request);

        return redirect_to_resource();
    }
}
