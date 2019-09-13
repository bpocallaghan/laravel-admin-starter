<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests;
use Bpocallaghan\Titan\Models\Testimonial;

class TestimonialsController extends WebsiteController
{
    /**
     * Show the testimonials page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Testimonial::orderBy('list_order')->get();

        return $this->view('testimonials', compact('items'));
    }
}
