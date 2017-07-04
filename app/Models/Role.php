<?php

namespace App\Models;

use Titan\Models\TitanCMSModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends TitanCMSModel
{
    use SoftDeletes;

    // basic website
    public static $BASIC = 'website'; // 1

    // basic admin
    public static $ADMIN = 'admin'; // 2

    // admin + analytics
    public static $ANALYTICS = 'analytics'; // 3

    public static $ADMIN_SUPER = 'admin_super'; // 4

    public static $DEVELOPER = 'developer'; // 5

    protected $table = 'roles';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'title' => 'required|min:3:max:255',
    ];

    public function getIconTitleAttribute()
    {
        return '<i class="fa fa-' . $this->attributes['icon'] . '"</i> ' . $this->attributes['title'];
    }

    public function getTitleSlugAttribute()
    {
        return $this->attributes['title'] . ' (' . $this->attributes['slug'] . ')';
    }

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllLists()
    {
        return self::orderBy('title')->get()->pluck('title', 'id')->toArray();
    }
}