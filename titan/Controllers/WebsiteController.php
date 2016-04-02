<?php

namespace Titan\Controllers;

use App\Http\Requests;
use App\Models\NavigationWebsite;
use Titan\Controllers\Traits\BreadcrumbWebsite;

class WebsiteController extends TitanController
{
    use BreadcrumbWebsite;

    protected $baseViewPath = 'website.';

    protected $baseViewSubPath = '';

    protected $sportType;

    protected $pageTitle;

    protected $breadcrumb = '';

    function __construct()
    {
        $this->setSelectedNavigation();

        $this->generateBreadcrumb();
    }

    /**
     * Get the HTML Title
     * @return string
     */
    protected function getPageTitle()
    {
        return (strlen($this->pageTitle) < 2 ? $this->selectedNavigation['html_title'] : $this->pageTitle);
    }

    /**
     * Return / Render the view
     * @param       $view
     * @param array $data
     * @return $this
     */
    protected function view($view, $data = [])
    {
        return view($this->baseViewPath . $this->baseViewSubPath . $view, $data)
            ->with('HTMLTitle', $this->getTitle())
            ->with('HTMLDescription', $this->getDescription())
            ->with('HTMLImage', $this->getImage())
            ->with('navigation', $this->generateNavigation())
            ->with('breadcrumb', $this->breadcrumbHTML())
            ->with('pageTitle', $this->getPageTitle())
            ->with('selectedNavigation', $this->selectedNavigation);
    }

    /**
     * Get the html title (check for crud reserve word)
     * @return string
     */
    protected function getTitle()
    {
        $navigation = array_reverse($this->urlParentNavs);
        $this->title = strlen($this->title) > 5 ? $this->title . ' - ' : '';

        foreach ($navigation as $key => $nav) {
            $this->title .= $nav['html_title'] . ($key + 1 < count($navigation) ? ' - ' : '');
        }

        return parent::getTitle();
    }

    /**
     * Get the html title (check for crud reserve word)
     * @return string
     */
    protected function getDescription()
    {
        // this just allows the controller to overide the description
        if (strlen($this->description) <= 5) {
            $this->description = $this->selectedNavigation['html_description'];
        }

        return parent::getDescription();
    }

    /**
     * Get the selected navigation
     * @return mixed
     */
    private function setSelectedNavigation()
    {
        $url = $this->getCurrentUrl();
        $sections = $this->getCurrentUrlSections();

        // laravel removes last / get home / dashboard
        if ($url === false) {
            $nav = NavigationWebsite::where('slug', '/')->get()->first();
        }
        else {
            // find nav with url - get last (parent can have same url)
            $nav = NavigationWebsite::where('url', $url)
                ->orderBy('is_hidden', 'DESC')
                ->orderBy('url_parent_id')
                ->orderBy('list_main_order')
                ->get()
                ->last();
        }

        // we assume some params / reserved word is at the end
        if (!$nav && strlen($url) > 2) {
            // keep cutting off from url until we find him in the db
            foreach ($sections as $key => $slug) {
                $url = substr($url, 0, strripos($url, '/'));

                // find nav with url - get last (parent can have same url)
                $nav = NavigationWebsite::whereUrl($url)->get()->last();
                if ($nav) {
                    break;
                }
            }
        }

        // when nothing - fall back to home
        if (!$nav) {
            $nav = NavigationWebsite::where('slug', '/')->first();
        }

        $this->selectedNavigation = $nav;

        // get all navigations -> ON parent_id
        $this->parentNavs = $nav->getParentsAndYou();

        // get all navigations -> ON url_parent_id
        $this->urlParentNavs = $nav->getUrlParentsAndYou();

        return $this->selectedNavigation;
    }

    /**
     * Generate the Main Navigation's HTML + show Active
     * @return string
     */
    protected function generateNavigation()
    {
        $html = '';
        $navigation = NavigationWebsite::mainNavigation();

        foreach ($navigation as $key => $nav) {

            $extra = '';
            $link = url($this->baseUrl . $nav->url);
            $children = $this->generateNavigationChildren($nav);
            $class = (array_search_value($nav->id, $this->parentNavs) ? 'active' : '');

            if (strlen($children) > 2) {
                $link = '#';
                $class .= ' dropdown-toggle';
                $extra = ' <i class="icon-down-open-mini"></i>';
            }

            $html .= "<li class='$class'>";
            $html .= '<a class="' . $class . '" href="' . $link . '">' . $nav->title . $extra . '</a>';
            $html .= $children;
            $html .= '</li>';
        }

        return $html;
    }

    /**
     * Recursive generate the menu for all the children of given $nav
     * @param $parent
     * @return string
     */
    private function generateNavigationChildren($parent)
    {
        $html = '';
        $navigation = NavigationWebsite::whereParentIdORM($parent->id);

        $html .= '<ul>';
        foreach ($navigation as $key => $nav) {

            $url = (is_slug_url($nav->slug) ? $nav->slug : url($this->baseUrl . $nav->url));
            $children = NavigationWebsite::whereParentIdORM($nav->id);

            $html .= '<li>';
            $html .= '<a tabindex="-1" href="' . (count($children) > 0 ? '#' : $url) . '">' . $nav->title . '</a>';

            // if children
            if (count($children) > 0) {
                $html .= '<ul>';
            }

            foreach ($children as $c => $child) {
                $url = (is_slug_url($child->slug) ? $child->slug : url($this->baseUrl . $child->url));

                $html .= '<li><a tabindex="-1" href="' . $url . '">' . $child->title . '</a></li>';
            }

            // if children
            if (count($children) > 0) {
                $html .= '</ul>';
            }

            $html .= '</li>';
        }

        $html .= '</ul>';

        return (count($navigation) > 0 ? $html : '');
    }
}