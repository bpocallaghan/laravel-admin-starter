<?php

namespace App\Models;

use Titan\Models\TitanCMSModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends TitanCMSModel
{
    use SoftDeletes;

    public static $BASIC = 'basic'; // 1

    // Admin - Developer / access to everything
    public static $ADMIN = 'admin'; // 2

    // Super Admin - Developer / access to everything
    public static $DEVELOPER = 'developer'; // 3

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

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllLists()
    {
    	return self::orderBy('level')->get()->pluck('title', 'id')->toArray();
    }
}