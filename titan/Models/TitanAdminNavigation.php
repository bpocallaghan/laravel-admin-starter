<?php

namespace Titan\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class TitanAdminNavigation extends TitanCMSModel
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'navigation_admin';

    /**
     * Fillable fields
     *
     * @var array
     */
    // protected $fillable = [];

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     *
     * @var array
     */
    static public $rules = [
        'title' => 'required|min:3:max:255',
    ];

    /**
     * Get a the title + url concatenated
     *
     * @return string
     */
    public function getTitleUrlAttribute()
    {
        return $this->attributes['title'] . ' ( ' . $this->attributes['url'] . ' )';
    }

    /**
     * Get the parent
     *
     * @return \Eloquent
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    /**
     * Get the parent
     *
     * @return \Eloquent
     */
    public function urlParent()
    {
        return $this->belongsTo(self::class, 'url_parent_id', 'id');
    }

    /**
     * Get All navigation where parent id, and not hidden
     *
     * @param      $id
     * @param bool $hidden (if we need to include hidden)
     * @return mixed
     */
    static public function whereParentIdORM($id, $hidden = false)
    {
        $builder = self::whereParentId($id);
        if(!$hidden) {
            $builder->where('is_hidden', 0);
        }

        return $builder->orderBy('list_order')->get();
    }

    /**
     * Get the url from db
     * If true given, we generate a new one,
     * This us usefull if parent_id updated, etc
     *
     * @return \Eloquent
     */
    public function updateUrl()
    {
        $this->url = '';
        $this->generateCompleteUrl($this);

        if (strlen($this->slug) > 1) {
            $this->url .= (strlen($this->url) > 1 ? '/' : '') . $this->slug;
        }

        return $this;
    }

    /**
     * Generate the new nav based on parent_id
     *
     * @param $nav
     * @return \Illuminate\Support\Collection|static
     */
    private function generateCompleteUrl($nav)
    {
        $row = self::find($nav->url_parent_id);

        if ($row) {
            if (strlen($row->slug) > 1) {
                $this->url = $row->slug . (strlen($this->url) ? '/' . $this->url : '');
            }

            return $this->generateCompleteUrl($row);
        }

        return $row;
    }

    /**
     * Get All his parents and himself
     *
     * @return mixed
     */
    public function getParentsAndYou()
    {
        return $this->getParentsRecursive($this, []);
    }

    /**
     * Recursive find his parents
     *
     * @param $nav
     * @param $parents
     * @return mixed
     */
    private function getParentsRecursive($nav, $parents)
    {
        if ($parent = $nav->parent) {
            $parents = $this->getParentsRecursive($parent, $parents);
        }

        array_push($parents, $nav);

        return $parents;
    }

    /**
     * Get All his parents and himself
     *
     * @return mixed
     */
    public function getUrlParentsAndYou()
    {
        return $this->getUrlParentsRecursive($this, []);
    }

    /**
     * Recursive find his parents
     *
     * @param $nav
     * @param $parents
     * @return mixed
     */
    private function getUrlParentsRecursive($nav, $parents)
    {
        if ($urlParent = $nav->urlParent) {
            $parents = $this->getUrlParentsRecursive($urlParent, $parents);
        }

        array_push($parents, $nav);

        return $parents;
    }
}