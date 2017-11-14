<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Page;

class BaseWebsiteController extends Controller
{
    protected $baseViewPath = 'website.';

    // html meta headers
    protected $pageTitle = "";

    protected $title = "";

    protected $description = "";

    protected $image = '/images/share.jpg';

    protected $parentPages = [];

    protected $urlParentPages = [];

    protected $page = false;

    protected $navigation = [];

    protected $breadcrumbItems = [];

    function __construct()
    {
        $this->findCurrentPage();

        $this->setPageBreadcrumb();

        // as soon as controller is ready -  get the navigation
        $this->middleware(function ($request, $next) {
            $this->navigation = Page::getHeaderNavigation();

            return $next($request);
        });
    }

    /**
     * Get the HTML Title
     * @return string
     */
    protected function getPageTitle()
    {
        return (strlen($this->pageTitle) < 2 ? $this->page['title'] : $this->pageTitle);
    }

    /**
     * Get the HTML Title
     * @return string
     */
    protected function getTitle()
    {
        $navigation = array_reverse($this->urlParentPages);
        $this->title = strlen($this->title) > 5 ? $this->title . ' - ' : '';

        foreach ($navigation as $key => $nav) {
            $this->title .= $nav['title'] . ($key + 1 < count($navigation) ? ' - ' : '');
        }

        return trim($this->title . (strlen($this->title) < 2 ? '' : ' | ') . config('app.name'));
    }

    /**
     * Get the HTML Description
     * @return string
     */
    protected function getDescription()
    {
        // this just allows the controller to overide the description
        if (strlen($this->description) <= 5) {
            $this->description = $this->page['description'];
        }

        return trim($this->description . (strlen($this->description) < 2 ? '' : ' | ') . config('app.description'));
    }

    /**
     * Get the HTML Share Image
     *
     * @return string
     */
    protected function getImage()
    {
        return $this->image;
    }

    /**
     * Return / Render the view
     *
     * @param            $view
     * @param array      $data
     * @return $this
     */
    protected function view($view, $data = [])
    {
        return view($this->baseViewPath . $view, $data)
            ->with('image', $this->getImage())
            ->with('title', $this->getTitle())
            ->with('description', $this->getDescription())
            ->with('pageTitle', $this->getPageTitle())
            ->with('page', $this->page)//->with('navigation', $this->navigation)
            ->with('activeParents', $this->urlParentPages)
            ->with('breadcrumbItems', $this->breadcrumbItems)
            ->with('navigation', $this->navigation);
    }

    /**
     * Get the slug from the url (url inside website)
     *
     * @param string $prefix
     * @return string
     */
    protected function getCurrentUrl($prefix = '/')
    {
        //$url = substr(request()->url(), strlen(config('app.url')));
        // prefix (request can be http://xx and app.url is https)
        $url = request()->path();
        $url = $prefix . ltrim($url, $prefix);

        return $url;
    }

    /**
     * Explode the url into slug pieces
     *
     * @return array
     */
    protected function getCurrentUrlSections()
    {
        return explode('/', $this->getCurrentUrl());
    }

    /**
     * Get the selected navigation
     * @return mixed
     */
    protected function findCurrentPage()
    {
        $url = $this->getCurrentUrl();
        $sections = $this->getCurrentUrlSections();

        // laravel removes last / get home / dashboard
        if ($url === false) {
            $page = Page::where('slug', '/')->get()->first();
        }
        else {
            // find nav with url - get last (parent can have same url)
            $page = Page::where('url', $url)
                ->orderBy('is_hidden', 'DESC')
                ->orderBy('url_parent_id')
                ->orderBy('header_order')
                ->get()
                ->last();
        }

        // we assume some params / reserved word is at the end
        if (!$page && strlen($url) > 2) {
            // keep cutting off from url until we find him in the db
            foreach ($sections as $key => $slug) {
                $url = substr($url, 0, strripos($url, '/'));

                // find nav with url - get last (parent can have same url)
                $page = Page::whereUrl($url)->get()->last();
                if ($page) {
                    break;
                }
            }
        }

        // when nothing - fall back to home
        if (!$page) {
            $page = Page::find(1);
            if (config('app.env') == 'local' && !$page) {
                dd('Whoops. Page not found - please see if url is in the pages table');
            }
        }

        // set the selected navigation
        $this->page = $page;

        // get all navigations -> ON parent_id
        $this->parentPages = $page->getParentsAndYou();

        // get all navigations -> ON url_parent_id
        $this->urlParentPages = $page->getUrlParentsAndYou();

        $this->page->increment('views');

        return $this->page;
    }

    /**
     * Init and Generate the website's breadcrumb nav bar
     */
    private function setPageBreadcrumb()
    {
        $this->breadcrumbItems = collect();
        $this->addBreadcrumbLink('Home', '/', 'home');

        $prevTitle = 'Home';
        foreach ($this->parentPages as $k => $page) {

            if ($page->title != $prevTitle) {
                $url = (is_slug_url($page->slug) ? $page->slug : url($page->url));
                $this->addBreadcrumbLink($page->title, $url);
            }

            $prevTitle = $page->title;
        }
    }

    /**
     * Add a link to the breadcrumb
     * @param        $title
     * @param        $url
     * @param string $class
     */
    public function addBreadcrumbLink($title, $url, $class = '')
    {
        $this->breadcrumbItems->push((object) ['name' => $title, 'url' => $url, 'class' => $class]);
    }
}
