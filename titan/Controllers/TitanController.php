<?php
namespace Titan\Controllers;

use App\Http\Controllers\Controller;
use Request;

class TitanController extends Controller
{
    protected $baseUrl = '';

    protected $baseViewPath = '';

    // html meta headers
    protected $title = "";

    protected $description = "";

    protected $image = 'images/logo.png';

    protected $parentNavs = [];

    protected $urlParentNavs = [];

    protected $selectedNavigation = false;

    /**
     * Get the HTML Title
     *
     * @return string
     */
    protected function getTitle()
    {
        return trim($this->title . (strlen($this->title) < 2 ? '' : ' | ') . env('APP_TITLE'));
    }

    /**
     * Get the HTML Description
     *
     * @return string
     */
    protected function getDescription()
    {
        return trim($this->description . (strlen($this->description) < 2 ? '' : ' | ') . env('APP_DESCRIPTION'));
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
            ->with('HTMLTitle', $this->getTitle())
            ->with('HTMLDescription', $this->getDescription());
    }

    /**
     * Get the slug from the url (url inside website)
     *
     * @return string
     */
    protected function getCurrentUrl()
    {
        $url = rtrim(env('APP_URL'), '/') . '/';

        return substr(Request::url(), strlen($url . $this->baseUrl));
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
}