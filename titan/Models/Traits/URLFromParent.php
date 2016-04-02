<?php

namespace Titan\Models\Traits;

use App\Models\LogAdminActivity;
use ReflectionClass;

trait URLFromParent
{
    /**
     * Register the necessary event listeners.
     *
     * @return void
     */
    protected static function bootURLFromParent()
    {
        static::creating(function ($model) {
            $model->updateUrl($model);
        });

        static::updating(function ($model) {
            $model->updateUrl($model);
        });
    }

    /**
     * Get the prefix for the url
     * @return string
     */
    private function getURLPrefix()
    {
        if (property_exists($this, 'URLPrefix')) {
            return $this->URLPrefix;
        }

        return '';
    }

    /**
     * Get the postifx for the url
     * @return string
     */
    private function getURLPosfix()
    {
        if (property_exists($this, 'URLPostifx')) {
            return $this->URLPostifx;
        }

        return '';
    }

    /**
     * Get the url from db
     * If true given, we generate a new one,
     * This us usefull if parent_id updated, etc
     *
     * @return \Eloquent
     */

    public function updateUrl($model)
    {
        $this->url = '';
        $this->generateCompleteUrl($model);

        if (strlen($this->slug) > 1) {
            $this->url .= (strlen($this->url) > 1 ? '/' : '') . $this->slug;
        }

        // prefix the sport type and news - 'complete url'
        $this->url = $this->getURLPrefix() . $this->url . $this->getURLPosfix();

        return $this;
    }

    /**
     * Generate the new nav based on parent_id
     *
     * @param $model
     * @return \Illuminate\Support\Collection|static
     */
    private function generateCompleteUrl($model)
    {
        $row = self::find($model->parent_id);

        if ($row) {
            if (strlen($row->slug) > 1) {
                $this->url = $row->slug . (strlen($this->url) ? '/' . $this->url : '');
            }

            return $this->generateCompleteUrl($row);
        }

        return $row;
    }
}