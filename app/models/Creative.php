<?php

use \Michelf\MarkdownExtra;

/**
 * Creative
 */
class Creative extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'creative';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：创意的分类
     * @return object Category
     */
    public function category()
    {
        return $this->belongsTo('CreativeCategories', 'category_id');
    }

    /**
     * 模型对象关系：创意的分享者
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * 模型对象关系：创意的评论
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function comments()
    {
        return $this->hasMany('CreativeComment', 'creative_id');
    }

    /**
     * 模型对象关系：创意的图片
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function pictures()
    {
        return $this->hasMany('CreativePictures', 'creative_id');
    }

    /**
     * 访问器：创意内容（原始）
     * @return string
     */
    public function getContentAttribute($value)
    {
        return strip($value);
    }

    /**
     * 访问器：创意摘要（原始）
     * @return string
     */
    public function getExcerptAttribute($value)
    {
        return strip($value);
    }

    /**
     * 访问器：创意内容（HTML 格式）
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
     * 访问器：创意摘要（HTML 格式）
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
     * 访问器：文章内容（Markdown 格式）
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
     * 访问器：文章摘要（Markdown 格式）
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