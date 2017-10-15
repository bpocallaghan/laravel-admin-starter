<?php

namespace App\Models\Traits;

use App\Models\Photo;

trait Photoable
{
    /**
     * Get the cover photo attribute
     * @return bool
     */
    public function getCoverPhotoAttribute()
    {
        $photos = $this->photos;
        if ($photos->count() >= 1) {
            // get the cover photo
            $photo = $photos->where('is_cover', true)->first();
            if ($photo) {
                return $photo;
            }

            // no photo marked as cover - return first
            return $photos->first();
        }

        // no photos uploaded yet
        return false;
    }

    /**
     * Get all of the album's photos.
     */
    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
}