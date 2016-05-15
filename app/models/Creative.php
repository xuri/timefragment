<?php

/**
 * Creative
 */

use \Michelf\MarkdownExtra;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Creative extends BaseModel
{
    /**
     * Database table (without prefix)
     * @var string
     */
    protected $table = 'creative';

    /**
     * Soft delete
     * @var boolean
     */
    use SoftDeletingTrait;

    protected $softDelete = ['deleted_at'];

    /**
     * ORM (Object-relational model): Creative category
     * @return object Category
     */
    public function category()
    {
        return $this->belongsTo('CreativeCategories', 'category_id');
    }

    /**
     * ORM (Object-relational model): Creative author
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * ORM (Object-relational model): Creative comments
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function comments()
    {
        return $this->hasMany('CreativeComment', 'creative_id');
    }

    /**
     * ORM (Object-relational model): Creative pictures
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function pictures()
    {
        return $this->hasMany('CreativePictures', 'creative_id');
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
     * Access control: Content (Markdown format)
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
