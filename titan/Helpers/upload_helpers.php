<?php

if (!function_exists('upload_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param  string $path
     * @return string
     */
    function upload_path($path = '')
    {
        // path
        $path = env('PUBLIC_FOLDER') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $path;
        // remove trailing seperators (incase more than 1)
        // add 1 trailing seperator (to add file in directory)
        return rtrim(base_path($path), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }
}

if (!function_exists('upload_path_images')) {
    /**
     * Get the path to the public images folder.
     *
     * @param  string $path
     * @return string
     */
    function upload_path_images($path = '')
    {
        return upload_path('images' . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR);
    }
}

function get_file_extensions($type = 'image')
{
    switch ($type) {
        case 'image':
            return 'image/x-png, image/jpeg, image/jpg';
    }

    return '';
}

function form_file_type($type)
{
    switch ($type) {
        case 'image':
            return 'image/*';
            break;
        case 'pdf':
            return 'application/pdf';
            break;
    }
}

function get_min_width_height($width, $height, $minWidth = 100, $minHeight = 100)
{
    if ($width > $height) {
        $ratio = $width / $height;
        $height = $minHeight;
        $width = round($height * $ratio);
    }
    else {
        $ratio = $height / $width;
        $width = $minWidth;
        $height = round($width * $ratio);
    }

    return ['w' => $width, 'h' => $height];
}

function uploaded_images_url($name)
{
    return '/uploads/images/' . $name;
}