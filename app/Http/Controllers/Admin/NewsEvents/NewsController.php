<?php

namespace App\Http\Controllers\Admin\NewsEvents;

use App\Models\NewsCategory;
use Redirect;
use App\Http\Requests;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class NewsController extends AdminController
{
    /**
     * Display a listing of news.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();
        $items = News::with(['category', 'photos'])->get();

        return $this->view('news_events.index', compact('items'));
    }

    /**
     * Show the form for creating a new news.
     *
     * @return Response
     */
    public function create()
    {
        $categories = NewsCategory::getAllList();

        return $this->view('news_events.create_edit', compact('categories'));
    }

    /**
     * Store a newly created news in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate(News::$rules, News::$messages);

        $news = $this->createEntry(News::class, $attributes);

        return redirect_to_resource();
    }

    /**
     * Display the specified news.
     *
     * @param News $news
     * @return Response
     */
    public function show(News $news)
    {
        return $this->view('news_events.show')->with('item', $news);
    }

    /**
     * Show the form for editing the specified news.
     *
     * @param News $news
     * @return Response
     */
    public function edit(News $news)
    {
        $categories = NewsCategory::getAllList();

        return $this->view('news_events.create_edit', compact('categories'))->with('item', $news);
    }

    /**
     * Update the specified news in storage.
     *
     * @param News    $news
     * @param Request $request
     * @return Response
     */
    public function update(News $news, Request $request)
    {
        $attributes = request()->validate(News::$rules, News::$messages);

        $news = $this->updateEntry($news, $attributes);

        return redirect_to_resource();
    }

    /**
     * Remove the specified news from storage.
     *
     * @param News    $news
     * @param Request $request
     * @return Response
     */
    public function destroy(News $news, Request $request)
    {
        $this->deleteEntry($news, $request);

        return redirect_to_resource();
    }
}
