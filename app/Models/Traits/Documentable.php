<?php

namespace App\Models\Traits;

use App\Models\Document;

trait Documentable
{
    /**
     * Get the first document
     * @return mixed
     */
    public function getDocumentAttribute()
    {
        return $this->documents()->first();
    }

    public function getDocumentUrlAttribute()
    {
        return url("/uploads/documents/{$this->document->filename}");
    }

    /**
     * Get all of the post's comments.
     */
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}