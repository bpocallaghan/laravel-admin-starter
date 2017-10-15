<?php

if (!function_exists('photo_url')) {
    function photo_url($name)
    {
        return config('app.url') . '/uploads/photos/' . $name;
    }
}