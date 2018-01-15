<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;

/**
 * Class Photo
 * @mixin \Eloquent
 */
class Photo extends TitanCMSModel
{
    use SoftDeletes;

    static public $thumbAppend = '-tn';

    static public $originalAppend = '-o';

    protected $table = 'photos';

    protected $guarded = ['id'];

    protected $appends = ['thumb', 'original_filename', 'url'];

    static public $rules = [
        'file' => 'required|image|max:5000|mimes:jpg,jpeg,png,bmp'
    ];

    /**
     * Get the Tag many to many
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photoable()
    {
        return $this->morphTo();
    }

    /**
     * Get the thumb path (append -tn at the end)
     * @return mixed
     */
    public function getThumbAttribute()
    {
        return $this->appendBeforeExtension(self::$thumbAppend);
    }

    /**
     * Get the thumb path (append -tn at the end)
     * @return mixed
     */
    public function getOriginalFilenameAttribute()
    {
        return $this->appendBeforeExtension(self::$originalAppend);
    }

    /**
     * Get the extension
     * @return bool|string
     */
    public function getExtensionAttribute()
    {
        return substr($this->filename, strpos($this->filename, '.'));
    }

    /**
     * Get the url to the photo
     * @return string
     */
    public function getUrlAttribute()
    {
        return $this->urlForName($this->filename);
    }

    /**
     * Get the thumb url
     * @return string
     */
    public function getThumbUrlAttribute()
    {
        return $this->urlForName($this->thumb);
    }

    /**
     * Get the original url
     * @return string
     */
    public function getOriginalUrlAttribute()
    {
        return $this->urlForName($this->original_filename);
    }

    /**
     * Get the url for the file name (specify thumb, default, original)
     * @param $name
     * @return string
     */
    public function urlForName($name)
    {
        return config('app.url') . '/uploads/photos/' . $name;
    }

    /**
     * Apends a string before the extension
     * @param $append
     * @return mixed
     */
    private function appendBeforeExtension($append)
    {
        return substr_replace($this->filename, $append, strpos($this->filename, '.'), 0);
    }
}