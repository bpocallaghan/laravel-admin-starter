<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;

/**
 * Class PageContent
 * @mixin \Eloquent
 */
class PageContent extends TitanCMSModel
{
    use SoftDeletes;

    protected $table = 'page_content';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'heading'         => 'required|min:3:max:255',
        'heading_element' => 'required|max:2',
        'content'         => 'required|max:8000',
        'page_id'         => 'required|exists:pages,id',
    ];

    /**
     * Get the summary text
     *
     * @return mixed
     */
    public function getSummaryAttribute()
    {
        return substr(strip_tags($this->attributes['content']), 0, 120) . '...';
    }

	/**
	 * Get the Page many to many
	 */
	public function pages()
	{
		return $this->belongsToMany(Page::class);
	}
}