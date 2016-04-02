<?php

namespace Titan\Models\Traits;

use ReflectionClass;

trait URLFromCategory
{
    /**
     * Register the necessary event listeners.
     *
     * @return void
     */
    protected static function bootURLFromCategory()
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
     * @param $model
     * @return \Eloquent
     */

    public function updateUrl($model)
    {
        $this->url = '';
        $category = $this->eloqent()->where('id', $model->category_id)->first();

        if ($category) {
            $this->url = $this->getURLPrefix() . $category->url . '/' . $this->slug . $this->getURLPosfix();
        }

        return $this;
    }

    /**
     * Get the Eloquent Class
     * @return object
     */
    private function eloqent()
    {
        $resource = property_exists($this, 'categoryResource')? $this->categoryResource : 'App\Models\Category';

        return (new ReflectionClass($resource))->newInstanceArgs();
    }
}