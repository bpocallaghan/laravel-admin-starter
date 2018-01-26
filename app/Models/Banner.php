<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;
use Titan\Models\Traits\ActiveTrait;
use Titan\Models\Traits\ImageThumb;

class Banner extends TitanCMSModel
{
    use SoftDeletes, ActiveTrait, ImageThumb;

    protected $table = 'banners';

    protected $guarded = ['id'];

    protected $dates = ['active_form', 'active_to'];

    public static $LARGE_SIZE = [1920, 500];

    public static $THUMB_SIZE = [576, 150];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'name'        => 'required|min:3:max:255',
        'summary'     => 'nullable|max:500',
        'action_name' => 'nullable|max:500',
        'action_url'  => 'nullable|max:500',
        'active_from' => 'nullable|date',
        'active_to'   => 'nullable|date',
        'photo'       => 'required|image|max:6000|mimes:jpg,jpeg,png,bmp',
    ];

    /**
     * Get all the rows as an array (ready for dropdowns)
     *
     * @return array
     */
    public static function getAllList()
    {
        return self::active()->orderBy('name')->get()->pluck('name', 'id')->toArray();
    }

	/**
	 * Get the Page many to many
	 */
	public function pages()
	{
		return $this->belongsToMany(Page::class);
	}

    /**
     * Get the is active label attribute
     * @return string
     */
    public function getIsActiveLabelAttribute()
    {
        $title = 'Not Active';
        $class = 'danger';

        $from = Carbon::parse($this->active_from);
        $to = Carbon::parse($this->active_to);

        if (!$this->active_to || Carbon::now()->diffInMinutes($to, false) > 0) {
            if (Carbon::now()->diffInMinutes($from, false) < 0) {
                $title = 'Active';
                $class = 'success';
            }
        }

        return "<span class='label label-{$class}'>{$title}</span>";
    }
}