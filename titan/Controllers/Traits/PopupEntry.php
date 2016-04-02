<?php

namespace Titan\Controllers\Traits;

use ReflectionClass;
use App\Models\Video;
use App\Models\Gigapan;
use App\Models\Video360;
use App\Models\VirtualTour;
use App\Models\Photography;
use App\Models\Illustration;

trait PopupEntry
{
    private function getPopupEntry()
    {
        $classes = [
            Photography::class,
            Video::class,
        ];

        $popup = false;
        foreach ($classes as $k => $resource) {

            $item = $this->getPopupEloquentEntry($resource);
            if ($item) {

                if(!$popup) {
                    $popup = $item;
                } else if($item->active_from->gt($popup->active_from)) {
                    $popup = $item;
                }
            }
        }

        if($popup) {
            $type = str_replace('App\Models\\', '', get_class($popup));
            if ($type == 'Video360') {
                $type = '360 Video';
            }

            $popup->type = $type;
        }

        return $popup;
    }

    /**
     * Get a featured item
     * @param     $resource
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    private function getPopupEloquentEntry($resource, $limit = 1, $offset = 0)
    {
        $eloquent = $this->eloqent($resource);
        $builder = $eloquent::active()
            ->where('is_popup', 1)
            ->orderBy('active_from', 'DESC')
            ->offset($offset);

        if ($limit == 1) {
            return $builder->first();
        }

        return $builder->limit($limit)->get();
    }

    /**
     * Get a featured item
     * @param     $resource
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    private function featuredItems($resource, $limit = 1, $offset = 0)
    {
        $eloquent = $this->eloqent($resource);
        $builder = $eloquent::active()
            ->where('is_featured', 1)
            ->orderBy('active_from', 'DESC')
            ->offset($offset);

        if ($limit == 1) {
            return $builder->first();
        }

        return $builder->limit($limit)->get();
    }

    /**
     * Get the Eloquent Class
     * @param $resource
     * @return object
     */
    private function eloqent($resource)
    {
        return (new ReflectionClass($resource))->newInstanceArgs();
    }
}