<?php
namespace Titan\Controllers;

use App\Models\NavigationAdmin;
use Titan\Controllers\Traits\CRUDNotify;

class TitanAdminController extends TitanController
{
    use CRUDNotify;

    protected $baseUrl = 'admin/';

    protected $baseViewPath = 'admin.';

    // name of the resource we are viewing / modify
    protected $resource = '';

    function __construct()
    {
        $this->setSelectedNavigation();
    }

    /**
     * Get the html title (check for crud reserve word)
     *
     * @return string
     */
    protected function getTitle()
    {
        if (strlen($this->title) <= 5) {
            if ($word = $this->checkIfReservedWordInUrl()) {
                $this->title .= ucfirst($word) . ' ';
            }

            $navigation = array_reverse($this->urlParentNavs);
            foreach ($navigation as $key => $nav) {
                $this->title .= $nav->title . ($key + 1 < count($navigation) ? ' - ' : '');
            }
        }

        return $this->title . ' - Admin | ' . env('APP_TITLE');
    }

    /**
     * Return / Render the view
     *
     * @param       $view
     * @param array $data
     * @return $this
     */
    protected function view($view, $data = [])
    {
        $navigation = $this->generateNavigation();
        $breadcrumb = $this->getBreadCrumb();

        $pagecrumb = $this->getPagecrumb();

        return parent::view($view, $data)
            ->with('navigation', $navigation)
            ->with('breadcrumb', $breadcrumb)
            ->with('pagecrumb', $pagecrumb)
            ->with('resource', $this->resource)
            ->with('selectedNavigation', $this->selectedNavigation);
    }

    /**
     * Generate the Main Navigation's HTML + show Active
     *
     * @return string
     */
    private function generateNavigation()
    {
        $html = '<ul class="sidebar-menu"><li class="header">MAIN NAVIGATION</li>';
        $navigation = NavigationAdmin::whereParentIdORM(0);

        foreach ($navigation as $key => $nav) {

            $active = (array_search_value($nav->id, $this->urlParentNavs) ? 'active open' : '');

            $children = $this->generateNavigationChildren($nav);

            $link = (strlen($children) < 2 ? url($this->baseUrl . $nav->url) : '#');
            $childrenClass = (strlen($children) < 2 ? '' : ' treeview ');

            $html .= '<li class="' . $active . $childrenClass . '"><a href="' . $link . '">';
            $html .= '<i class="fa fa-fw fa-' . $nav->icon . '"></i> ';
            $html .= '<span>' . $nav->title . '</span>';
            if (strlen($children) > 2) {
                $html .= '<i class="fa fa-angle-left pull-right"></i>';
            }
            $html .= '</a>' . $children;
            $html .= '</li>';
        }

        $html .= '</ul>';

        return $html;
    }

    /**
     * Recursive generate the menu for all the children of given $nav
     *
     * @param $parent
     * @return string
     */
    private function generateNavigationChildren($parent)
    {
        $html = '<ul class="treeview-menu">';
        $navigation = NavigationAdmin::whereParentIdORM($parent->id);

        foreach ($navigation as $key => $nav) {
            $active = (array_search_value($nav->id, $this->urlParentNavs) ? 'active open' : '');

            $children = $this->generateNavigationChildren($nav);

            $link = (strlen($children) < 2 ? url($this->baseUrl . $nav->url) : '#');
            $childrenClass = (strlen($children) < 2 ? '' : ' treeview ');

            $html .= '<li class="' . $active . $childrenClass . '"><a href="' . $link . '">';
            $html .= (strlen($nav->icon) > 2 ? '<i class="fa fa-fw fa-' . $nav->icon . '"></i> ' : '');
            $html .= '<span>' . $nav->title . '</span>';
            if (strlen($children) > 2) {
                $html .= '<i class="fa fa-angle-left pull-right"></i>';
            }
            $html .= '</a>' . $children;
            $html .= '</li>';
        }

        $html .= '</ul>';

        return (count($navigation) >= 1 ? $html : '');
    }

    /**
     * Generate the breadcrumbs
     * TODO: check for reserved words and some parent links are only for show (not clickable)
     *
     * @return string
     */
    protected function getBreadCrumb()
    {
        $navigation = $this->urlParentNavs;
        $url = env('APP_URL') . $this->baseUrl;
        $html = '<ol class="breadcrumb">';

        // for dashboard, only add home
        if (count($navigation) == 1 && $navigation[0]->title == 'Dashboard') {
            $html .= '<li><a href="' . $url . '"><i class="fa fa-home"></i> Dashboard</a></li>';
        }
        else {
            foreach ($navigation as $key => $nav) {
                $html .= '<li>';
                $icon = (strlen($nav->icon) > 2 ? '<i class="fa fa-' . $nav->icon . '"></i> ' : '');
                $html .= '<a href="' . url($this->baseUrl . $nav->url) . '">' . $icon . '' . $nav->title . '</a>';
                $html .= '</li>';
            }

            // TODO: show edit / create, etc icon ?
            if ($word = $this->checkIfReservedWordInUrl()) {
                $html .= '<li>';
                $html .= ucfirst($word);
                $html .= '</li>';
            };
        }

        return $html . '</ol>';
    }

    public function getPagecrumb()
    {
        $navigation = $this->urlParentNavs;
        $url = env('APP_URL') . $this->baseUrl;
        $html = '<h1>';

        // for dashboard, only add home
        if (count($navigation) == 1 && $navigation[0]->title == 'Dashboard') {
            $html .= '<i class="fa fa-home"></i> Dashboard';
        }
        else {

            //foreach ($navigation as $key => $nav) {
            //    $html .= '<li>';
            //    $html .= '<i class="fa fa-' . $nav->icon . '"></i> ' . $nav->title;
            //    $html .= '</li>';
            //}

            $html .= '<i class="fa fa-' . $this->selectedNavigation->icon . '"></i> ' . $this->selectedNavigation->title;

            // TODO: show edit / create, etc icon ?
            if ($word = $this->checkIfReservedWordInUrl()) {
                $html .= '<small>';
                $html .= ucfirst($word);
                $html .= '</small>';
            };
        }

        return $html . '</h1>';
    }

    /**
     * Check if one of the keywords are in the url
     *
     * @param bool $url
     * @return bool
     */
    protected function checkIfReservedWordInUrl($url = false)
    {
        $sections = $this->getCurrentUrlSections();
        if (count($sections) >= 1) {
            $last = intval($sections[count($sections) - 1]);
        }

        $keywords = [
            'show',
            'create',
            'edit',
        ];

        foreach ($sections as $key => $slug) {
            if (in_array($slug, $keywords)) {
                return $slug;
            }
        }

        // resource ID
        if ($last >= 1) {
            return 'show';
        }

        return false;
    }

    /**
     * Set the Current Navigation
     * Find the navigations parents and url parents
     *
     * @return bool
     */
    protected function setSelectedNavigation()
    {
        $url = $this->getCurrentUrl();
        $sections = $this->getCurrentUrlSections();

        // laravel removes last /
        if ($url === false) {
            // dahboard (substring from the /, laravel removes last /)
            $nav = NavigationAdmin::whereSlug('/')->get()->last();
        }
        else {
            // find nav with url - get last (parent can have same url)
            $nav = NavigationAdmin::where('url', '=', $url)
                ->orderBy('is_hidden', 'DESC')//->orderBy('url_parent_id')
                ->orderBy('list_order')
                ->get()
                ->last();
        }

        // we assume some params / reserved word is at the end
        if (!$nav && strlen($url) > 2) {
            // keep cutting off from url until we find him in the db
            foreach ($sections as $key => $slug) {
                $url = substr($url, 0, strripos($url, '/'));

                // find nav with url - get last (parent can have same url)
                $nav = NavigationAdmin::whereUrl($url)->get()->last();
                if ($nav) {
                    break;
                }
            }
        }

        // development testing
        if (!$nav) {
            dd('Oops - unique url, please fix at TitanAdminController::setselectedNavigation()');
        }

        $this->selectedNavigation = $nav;

        // get all navigations -> ON parent_id
        $this->parentNavs = $nav->getParentsAndYou();

        // get all navigations -> ON url_parent_id
        $this->urlParentNavs = $nav->getUrlParentsAndYou();

        // name of resource - used on page to, eg, Add new 'resource', enter title of 'resource'
        $this->resource = str_singular($nav->title); // TODO: - maybe add a 'resource' field on the table

        $mode = $this->checkIfReservedWordInUrl();

        $this->selectedNavigation->mode = $mode == false ? 'index' : $mode;
        $this->selectedNavigation->url = '/' . $this->baseUrl . rtrim($nav->url, '/') . '/';

        return $this->selectedNavigation;
    }

    /**
     * Get the items, check if we use ajax or send items to view
     * Return the index view
     * @param string $view
     * @return mixed
     */
    protected function showIndex($view = '')
    {
        $items = $this->getTableRows();
        $ajax = count($items) > 150 ? 'true' : 'false';

        return $this->view($view, compact('ajax'))->with('items', $ajax == 'true' ? [] : $items);
    }

    /**
     * Return the data formatted for the table
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {
        $items = $this->getTableRows();

        return Datatables::of($items)->addColumn('action', function ($row) {
            return action_row($this->selectedNavigation->url, $row->id, $row->title,
                ['edit', 'delete']);
        })->make(true);
    }
}