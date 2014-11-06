<?php

/**
 * Travel
 */

use \Michelf\MarkdownExtra;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Travel extends BaseModel
{
	/**
	 * Database table (without prefix)
	 * @var string
	 */
	protected $table = 'travel';

	/**
	 * Soft delete
	 * @var boolean
	 */
	use SoftDeletingTrait;

	protected $softDelete = ['deleted_at'];

	/**
	 * ORM (Object-relational model): Travel category
	 * @return object Category
	 */
	public function category()
	{
		return $this->belongsTo('TravelCategories', 'category_id');
	}

	/**
	 * ORM (Object-relational model): Travel author
	 * @return object User
	 */
	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/**
	 * ORM (Object-relational model): Travel comments
	 * @return object Illuminate\Database\Eloquent\Collection
	 */
	public function comments()
	{
		return $this->hasMany('TravelComment', 'travel_id');
	}

	/**
	 * ORM (Object-relational model): Travel pictures
	 * @return object Illuminate\Database\Eloquent\Collection
	 */
	public function pictures()
	{
		return $this->hasMany('TravelPictures', 'travel_id');
	}

	/**
	 * Access control: Content (original)
	 * @return string
	 */
	public function getContentAttribute($value)
	{
		return strip($value);
	}

	/**
	 * Access control: Abstract (original)
	 * @return string
	 */
	public function getExcerptAttribute($value)
	{
		return strip($value);
	}

	/**
	 * Access control: Content (HTML format)
	 * @return string
	 */
	public function getContentHtmlAttribute()
	{
		switch ($this->content_format) {
			case 'markdown':
				return MarkdownExtra::defaultTransform($this->content);
			case 'html':
				return $this->content;
		}
	}

	/**
	 * Access control: Abstract (HTML format)
	 * @return string
	 */
	public function getExcerptHtmlAttribute()
	{
		switch ($this->excerpt_format) {
			case 'markdown':
				return MarkdownExtra::defaultTransform($this->excerpt);
			case 'html':
				return $this->excerpt;
		}
	}

	/**
	 * Access control: Content (Mardown format)
	 * @return string
	 */
	public function getContentMarkdownAttribute()
	{
		switch ($this->content_format) {
			case 'markdown':
				return $this->content;
			case 'html':
				return new HTML_To_Markdown($this->content);
		}
	}

	/**
	 * Access control: Abstract (Markdown format)
	 * @return string
	 */
	public function getExcerptMarkdownAttribute()
	{
		switch ($this->excerpt_format) {
			case 'markdown':
				return $this->excerpt;
			case 'html':
				return new HTML_To_Markdown($this->excerpt);
		}
	}


}