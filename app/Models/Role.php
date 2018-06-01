<?php

namespace App\Models;

use Titan\Models\TitanCMSModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends TitanCMSModel
{
    use SoftDeletes;

    // basic website
    public static $WEBSITE = 'website'; // 1

    // base user
    public static $USER = 'user'; // 2

    // basic admin
    public static $BASE_ADMIN = 'base_admin'; // 3

    public static $ADMIN_SUPER = 'admin'; // 4

    public static $DEVELOPER = 'developer'; // 5

    // base admin + analytics only
    public static $ANALYTICS = 'analytics'; // 6

    protected $table = 'roles';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'name' => 'required|min:3:max:255',
    ];

    public function getIconTitleAttribute()
    {
        return '<i class="fa fa-' . $this->attributes['icon'] . '"</i> ' . $this->attributes['name'];
    }

    public function getTitleSlugAttribute()
    {
        return $this->attributes['name'] . ' (' . $this->attributes['slug'] . ')';
    }

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllLists()
    {
        return self::orderBy('name')->get()->pluck('name', 'id')->toArray();
    }
}