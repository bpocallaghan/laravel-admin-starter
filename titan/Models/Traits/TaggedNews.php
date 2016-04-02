<?php

namespace Titan\Models\Traits;

use DB;
use App\Models\News;
use App\Models\NewsTag;

trait TaggedNews
{
    public $newsLatest = [];

    /**
     * Get the news entries tagged to me
     * @param int $limit
     * @return \Eloquent
     */
    public function news($limit = 5)
    {
        if (count($this->newsLatest) >= 1) {
            return $this->newsLatest;
        }

        // get class name that include this file (model name)
        $parent = str_replace('AppModels', '', stripslashes(static::class));

        $rows = DB::select("SELECT news.* FROM $this->table
            INNER JOIN news_tag ON news_tag.subject_id = $this->table.id
            INNER JOIN news ON news.id = news_tag.news_id
            WHERE $this->table.id = ? AND news_tag.subject_type LIKE ?
            GROUP BY news.id
            ORDER BY news.created_at DESC", [$this->id, '%' . $parent]);

        $news = collect();
        // filter active and get photos for entry
        foreach ($rows as $k => $row) {

            $item = News::where('id', $row->id)->active()->first();
            if ($item) {
                $item->images; // get the images
                $news->push($item);
            }
        }

        $this->newsLatest = $news->take($limit);

        return $this->newsLatest;

        // old / default way
        return $this->hasMany(NewsTag::class, 'subject_id', 'id')
            ->where('subject_type', get_class($this))
            ->with('news')
            ->orderBy('created_at', 'DESC');
    }
}