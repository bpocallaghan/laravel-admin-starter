<?php

namespace App\Http\Controllers\Website;

use App\Models\FAQ;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FAQController extends WebsiteController
{
    public function index()
    {
        $categories = FaqCategory::getAllList();
        $items = FaqCategory::with('faqs')->orderBy('name')->get();

        return $this->view('faq', compact('items', 'categories'));
    }

    /**
     * Increments the total views
     * @param FAQ    $faq
     * @param string $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function incrementClick(FAQ $faq, $type = 'total_read')
    {
        if ($type == 'total_read' || $type == 'helpful_yes' || $type == 'helpful_no') {
            $faq->increment($type);
        }

        return json_response('');
    }
}