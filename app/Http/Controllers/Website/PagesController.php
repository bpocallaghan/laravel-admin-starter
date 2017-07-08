<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests;
use App\Models\Changelog;
use App\Models\Testimonial;

class PagesController extends WebsiteController
{
    public function column1()
    {
        return $this->view('column_1');
    }

    public function column2()
    {
        return $this->view('column_2');
    }

    public function column3()
    {
        return $this->view('column_3');
    }

    public function column4()
    {
        return $this->view('column_4');
    }

    /**
     * Show the changelog page
     *
     * @return \Illuminate\Http\Response
     */
    public function changelog()
    {
        $items = Changelog::orderBy('version', 'DESC')->get();

        return $this->view('changelog', compact('items'));
    }

    /**
     * Show the changelog page
     *
     * @return \Illuminate\Http\Response
     */
    public function testimonials()
    {
        $items = Testimonial::orderBy('list_order')->get();

        return $this->view('testimonials', compact('items'));
    }
}
