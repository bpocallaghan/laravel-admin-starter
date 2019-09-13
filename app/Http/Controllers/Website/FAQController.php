<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests;
use Illuminate\Http\Request;
use Bpocallaghan\Titan\Models\FAQ;
use Bpocallaghan\Titan\Models\FaqCategory;
use App\Http\Controllers\Website\WebsiteController;

class FAQController extends WebsiteController
{
    public function index()
    {
        $categories = FaqCategory::getAllList();
        $items = FaqCategory::with('faqs')->orderBy('name')->get();

        return $this->view('faqs.faq', compact('items', 'categories'));
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