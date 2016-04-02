<?php

namespace Titan\Models\Traits;

use App\Models\Image;
use DB;
use App\Models\ImageTag;

trait TaggedImages
{
    public $imagesTagged = [];

    /**
     * Get all the images linked to entry
     *
     * @return \Eloquent
     */
    public function getImagesAttribute()
    {
        return $this->images();
    }

    /**
     * Get the Photo set as cover
     *
     * @return object
     */
    public function getCoverAttribute()
    {
        $images = $this->images();

        return (count($images) >= 1 ? $images[0] : (object) [
            'title' => '',
            'thumb' => 'placeholder.jpg',
            'name'  => 'placeholder.jpg'
        ]);
    }

    /**
     * Get the images tagged to this model
     * @param int $limit
     * @return \Eloquent
     */
    public function images($limit = 50)
    {
        if (count($this->imagesTagged) >= 1) {
            return $this->imagesTagged;
        }

        $parent = str_replace('AppModels', '', stripslashes(static::class));

        $rows = DB::select("SELECT images.*, image_tag.id as image_tag_id, image_tag.is_cover
            FROM $this->table
            INNER JOIN image_tag ON image_tag.subject_id = $this->table.id
            INNER JOIN images ON images.id = image_tag.image_id
            WHERE images.deleted_at IS NULL AND $this->table.id = ? AND image_tag.subject_type LIKE ?
            GROUP BY images.id
            ORDER BY image_tag.is_cover DESC, images.updated_at DESC
            LIMIT $limit", [$this->id, '%' . $parent]);

        //$this->imagesTagged = $rows;

        $images = collect();
        // filter active and get photos for entry
        foreach ($rows as $k => $row) {

            $item = $row;
            $item->thumb = substr_replace($row->name, Image::$thumbAppend, strpos($row->name, '.'),
                0);

            $item->original = substr_replace($row->name, Image::$originalAppend,
                strpos($row->name, '.'), 0);

            $images->push($item);
        }

        $this->imagesTagged = $images;

        return $this->imagesTagged;

        // old / default way
        return $this->hasMany(ImageTag::class, 'subject_id', 'id')
            ->where('subject_type', get_class($this))
            ->with('image')
            ->orderBy('created_at', 'DESC');
    }
}