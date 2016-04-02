<?php

namespace App\Http\Controllers\Traits;

use App\Models\Category;
use ReflectionClass;

trait ContentHelper
{
    /**
     * Display all the active resources
     *
     * @param null $category
     * @return $this|\Illuminate\Http\JsonResponse
     */
    private function showList($category = null)
    {
        // eloquent model - VirtualTour::class
        $eloquent = $this->eloqent();

        // base builder
        $builder = $eloquent::with('category')->active();

        // if we need to filter by category
        if ($category && strlen($category) > 2) {

            $category = $this->eloqentCategory()->where('slug', $category)->first();

            if (!$category) {
                return redirect($this->URLPrefix);
            }

            // increment (dont increment on ajax pagination)
            if (!$this->request->ajax()) {

                // prefix the category in title
                $this->title = $category->title;

                // increment total views
                $category->increment('total_views');
                if ($category->getTable() == 'categories') {
                    $category->increment("views_" . $eloquent->getTable());
                }
            }

            // filter by category
            $builder->where('category_id', $category->id);
        }

        // order by date desc, paginate
        $items = $builder->orderBy('active_from', 'DESC')->paginate($this->paginate);

        // if ajax - paginate the articles
        if ($this->request->ajax()) {

            $view = "website.partials.content.pagination";
            if ($this->view == 'photographies') {
                $view = "website.partials.$this->view.pagination";
            }

            return response()->json(view()->make($view, compact('items'))->render());
        }

        $categories = $this->categoriesHTML($category);
        if ($category) {
            $this->addBreadcrumbLink($category->title, '/content/' . $category->url);
        }

        return $this->view("content.$this->view", compact('categories', 'items'));
    }

    /**
     * Get the current resource
     * @param $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function getResource($category)
    {
        $category = $this->eloqentCategory()->where('slug', $category)->first();

        if (!$category) {
            return redirect($this->URLPrefix);
        }

        // eloquent model - VirtualTour::class
        $eloquent = $this->eloqent();

        // prefix the / -> the way we save it in db
        $url = '/' . ltrim($this->getCurrentUrl(), '/');
        $item = $eloquent::with('category')->where('url', $url)->first();

        if (!$item) {
            return redirect($this->URLPrefix);
        }

        $item->increment('total_views');

        return $item;
    }

    /**
     * Set HTML Page Headers
     * @param $resource
     */
    private function setPageHeaders($resource)
    {
        $this->title = $resource->title;
        $this->pageTitle = $resource->category->title;
        $this->description = $resource->title . ' ' . $resource->summary;
        $this->image = ltrim(uploaded_images_url($resource->image), '/');
        $this->addBreadcrumbLink($resource->category->title,
            $this->URLPrefix . $resource->category->url);
        $this->addBreadcrumbLink($resource->title, $resource->url);

        $this->setBanners($resource->image, $resource->title, $resource->summary);
    }

    /**
     * Display a specific resource
     * @param $resource
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    private function showResource($resource)
    {
        return $this->view("content.$this->view" . "_show", compact('resource'));
    }

    /**
     * Get the categories HTML
     *
     * @param null $category
     * @return string
     */
    private function categoriesHTML($category = null)
    {
        $categories = $this->eloqentCategory()->all();
        $total = $this->eloqent()->active()->count();

        $categoryId = 0;
        if ($category) {
            $categoryId = $category->id;
        }

        // get the relationship name - same as view
        $relationship = $this->view;
        $title = 'All <span>(' . $total . ')</span>';
        $html = '<li><a href="' . $this->URLPrefix . '" class="' . ($categoryId == 0 ? 'active' : '') . '">' . $title . '</a></li>';
        foreach ($categories as $k => $category) {

            // get total items for relationship / category
            $total = $category->{$relationship}()->count();

            if ($total > 0) {
                $active = $category->id == $categoryId ? 'active' : '';
                $title = $category->title . ' <span>(' . $total . ')</span>';
                $html .= '<li><a href="' . $this->URLPrefix . $category->url . '" class="' . $active . '">' . $title . ' </a></li>';
            }
        }

        return $html;
    }

    /**
     * Get the Eloquent Class
     * @return object
     */
    private function eloqent()
    {
        return (new ReflectionClass($this->resource))->newInstanceArgs();
    }

    /**
     * Get the Eloquent Class
     * @return object
     */
    private function eloqentCategory()
    {
        $resource = property_exists($this,
            'resourceCategory') ? $this->resourceCategory : 'App\Models\Category';

        return (new ReflectionClass($resource))->newInstanceArgs();
    }
}