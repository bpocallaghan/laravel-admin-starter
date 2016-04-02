<?php

namespace Titan\Models\Traits;

trait ImageThumb
{
    static public $thumbAppend = '-tn';

    static public $originalAppend = '-o';

    //protected $appends = ['thumb', 'original'];

    /**
     * Get the thumb path (append -tn at the end)
     * @return mixed
     */
    public function getImageThumbAttribute()
    {
        return $this->appendBeforeExtension(self::$thumbAppend);
    }

    /**
     * Get the thumb path (append -tn at the end)
     * @return mixed
     */
    public function getImageOriginalAttribute()
    {
        return $this->appendBeforeExtension(self::$originalAppend);
    }

    /**
     * Apends a string before the extension
     * @param $append
     * @return mixed
     */
    private function appendBeforeExtension($append)
    {
        return substr_replace($this->image, $append, strpos($this->image, '.'), 0);
    }
}