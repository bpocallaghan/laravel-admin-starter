<?php

namespace App\Http\Controllers\Website;

use App\Models\News;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsEventController extends WebsiteController
{
    public function index()
    {
        $perPage = 6;
        $page = input('page', 1);
        $baseUrl = config('app.url') . '/news-and-events';
        $items = News::whereHas('photos')->with('photos')->active()->orderBy('active_from', 'DESC')->get();

        $total = $items->count();

        // paginator
        $paginator = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(),
            $perPage, $page, ['path' => $baseUrl, 'originalEntries' => $total]);

        // if pagination ajax
        if (request()->ajax()) {
            return response()->json(view('website.news_events.pagination')
                ->with('paginator', $paginator)
                ->render());
        }

        return $this->view('news_events.news_events')->with('paginator', $paginator);
    }

    /**
     * Show News and Events
     * @param $newsSlug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($newsSlug)
    {
        $item = News::with('photos')->where('slug', $newsSlug)->first();
        if (!$item) {
            return redirect('/news-and-events');
        }

        $this->addBreadcrumbLink($item->title, false);

        return $this->view('news_events.news_event_show')->with('news', $item);
    }
}
