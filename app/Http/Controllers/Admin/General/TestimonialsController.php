<?php

namespace App\Http\Controllers\Admin;

use Redirect;
use App\Http\Requests;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class TestimonialsController extends AdminController
{
    /**
     * Display a listing of testimonial.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        return $this->view('testimonials.index')->with('items', Testimonial::all());
    }

    /**
     * Show the form for creating a new testimonial.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('testimonials.add_edit');
    }

    /**
     * Store a newly created testimonial in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Testimonial::$rules, Testimonial::$messages);

        $testimonial = $this->createEntry(Testimonial::class,
            $request->only(['customer', 'link', 'description']));

        log_activity('Testimonial Created', 'Testimonial was created ' . $testimonial->customer);

        return redirect_to_resource();
    }

    /**
     * Display the specified testimonial.
     *
     * @param Testimonial $testimonial
     * @return Response
     */
    public function show(Testimonial $testimonial)
    {
        return $this->view('testimonials.show')->with('item', $testimonial);
    }

    /**
     * Show the form for editing the specified testimonial.
     *
     * @param Testimonial $testimonial
     * @return Response
     */
    public function edit(Testimonial $testimonial)
    {
        return $this->view('testimonials.add_edit')->with('item', $testimonial);
    }

    /**
     * Update the specified testimonial in storage.
     *
     * @param Testimonial $testimonial
     * @param Request     $request
     * @return Response
     */
    public function update(Testimonial $testimonial, Request $request)
    {
        $this->validate($request, Testimonial::$rules, Testimonial::$messages);

        $this->updateEntry($testimonial, $request->only(['customer', 'link', 'description']));

        log_activity('Testimonial Updated', 'Testimonial was updated. ' . $testimonial->customer);

        return redirect_to_resource();
    }

    /**
     * Remove the specified testimonial from storage.
     *
     * @param Testimonial $testimonial
     * @param Request     $request
     * @return Response
     */
    public function destroy(Testimonial $testimonial, Request $request)
    {
        $this->deleteEntry($testimonial, $request);

        return redirect_to_resource();
    }
}
