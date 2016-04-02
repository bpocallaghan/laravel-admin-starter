<?php

namespace Titan\Controllers\Traits;

trait BreadcrumbWebsite
{
    protected $breadcrumbMenus;

    private function generateBreadcrumb()
    {
        $this->breadcrumbMenus = collect();

        $this->breadcrumbMenus->push(['title' => 'Home', 'url' => '/']);

        $prevTitle = 'Home';
        $navs = $this->selectedNavigation->getParentsAndYou();
        foreach ($navs as $k => $nav) {

            if ($nav->title != $prevTitle) {
                $url = (is_slug_url($nav->slug) ? $nav->slug : url($this->baseUrl . $nav->url));
                $this->breadcrumbMenus->push(['title' => $nav->title, 'url' => $url]);
            }

            $prevTitle = $nav->title;
        }
    }

    private function breadcrumbHTML()
    {
        $html = '';
        $total = count($this->breadcrumbMenus) - 1;

        foreach ($this->breadcrumbMenus as $k => $menu) {

            if ($k == $total) {
                $html .= '<li>' . $menu['title'] . '</li>';
            } else {
                $html .= '<li><a tabindex="-1" href="' . $menu['url'] . '">' . $menu['title'] . '</a></li>';
            }
        }

        return $html;
    }

    public function addBreadcrumbLink($title, $url)
    {
        $this->breadcrumbMenus->push(['title' => $title, 'url' => $url]);
    }
}