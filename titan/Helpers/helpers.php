<?php

if (!function_exists('user')) {
    /**
     * Get the logged in user
     *
     * @return \App\Models\User|null
     */
    function user()
    {
        return ((Auth::user()) ? Auth::user() : (object) ['id' => 0]);
    }
}

if (!function_exists('url_admin')) {
    /**
     * Generate a url for the application.
     *
     * @param  string $path
     * @param  mixed  $parameters
     * @param  bool   $secure
     * @return string
     */
    function url_admin($path = null, $parameters = [], $secure = null)
    {
        return app('url')->to('admin/' . $path, $parameters, $secure);
    }
}

if (!function_exists('route_admin')) {
    /**
     * Generate a URL to a named route.
     *
     * @param  string                    $name
     * @param  array                     $parameters
     * @param  bool                      $absolute
     * @param  \Illuminate\Routing\Route $route
     * @return string
     */
    function route_admin($name, $parameters = [], $absolute = true, $route = null)
    {
        return Redirect::to(app('url')->route('admin.' . $name, $parameters, $absolute, $route));
    }
}

if (!function_exists('input')) {
    /**
     * @param string $key
     * @param null   $default
     * @return mixed|null
     */
    function input($key = '', $default = null)
    {
        return (Illuminate\Support\Facades\Input::has($key) ? Illuminate\Support\Facades\Input::get($key) : $default);
    }
}

if (!function_exists('token')) {
    /**
     * Generates a random token
     *
     * @param  String $str [description]
     *
     * @return String      [description]
     */
    function token($str = null)
    {
        $str = isset($str) ? $str : \Illuminate\Support\Str::random();
        $value = str_shuffle(sha1($str . microtime(true)));
        $token = hash_hmac('sha1', $value, env('APP_KEY'));

        return $token;
    }
}

/**
 * Convert a csv to an array
 *
 * @param string $filename
 * @param string $delimiter
 * @return array|bool
 */
function csv_to_array($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename)) {
        return false;
    }

    $header = null;
    $data = [];
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
            if (!$header) {
                $header = $row;
            }
            else {
                $data[] = array_combine($header, $row);
            }
        }
        fclose($handle);
    }

    return $data;
}

/**
 * Search for a given value in $haystack
 * Can overide the default key to search on
 *
 * @param        $value
 * @param        $haystack
 * @param string $k
 * @return bool
 */
function array_search_value($value, $haystack, $k = 'id')
{
    foreach ($haystack as $key => $item) {
        if ($value == $item[$k]) {
            return true;
        }
    }

    return false;
}

/**
 * A Success json response
 * @param $response
 * @return \Illuminate\Http\JsonResponse
 */
function json_response($response = 'success')
{
    $data = [
        'success' => 1,
        'error'   => null,
        'data'    => $response,
    ];

    return response()->json($data);
}

/**
 * An Error json response
 * @param        $title
 * @param string $content
 * @param string $type
 * @return \Illuminate\Http\JsonResponse
 */
function json_response_error($title, $content = '', $type = 'popup')
{
    return response()->json([
        'success' => 0,
        'type'    => $type,
        'error'   => ['title' => $title, 'content' => $content]
    ]);
}

/**
 * An Error json response
 * @param $title
 * @param $content
 * @return \Illuminate\Http\JsonResponse
 */
function json_response_error_alert($title, $content = '')
{
    return json_response($title, $content, 'alert');
}

/**
 * Check if the slug is actually a valid url
 *
 * @param $slug
 * @return bool
 */
function is_slug_url($slug)
{
    if (strpos($slug, 'http://') === 0) {
        return true;
    }

    if (strpos($slug, 'https://') === 0) {
        return true;
    }

    if (strpos($slug, 'www.') === 0) {
        return true;
    }

    return false;
}