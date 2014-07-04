<?php

use \Michelf\MarkdownExtra;

/**
 * Jobs
 */
class Jobs extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'jobs';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 模型对象关系：职位分类
     * @return object Category
     */
    public function category()
    {
        return $this->belongsTo('JobsCategories', 'category_id');
    }

    /**
     * 模型对象关系：招聘者
     * @return object User
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * 模型对象关系：招聘信息的简介
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function comments()
    {
        return $this->hasMany('JobsComment', 'jobs_id');
    }

    /**
     * 模型对象关系：招聘信息的图片
     * @return object Illuminate\Database\Eloquent\Collection
     */
    public function pictures()
    {
        return $this->hasMany('JobsPictures', 'jobs_id');
    }

    /**
     * 访问器：内容（原始）
     * @return string
     */
    public function getContentAttribute($value)
    {
        return strip($value);
    }

    /**
     * 访问器：摘要（原始）
     * @return string
     */
    public function getExcerptAttribute($value)
    {
        return strip($value);
    }

    /**
     * 访问器：内容（HTML 格式）
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
     * 访问器：摘要（HTML 格式）
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
     * 访问器：内容（Markdown 格式）
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
     * 访问器：摘要（Markdown 格式）
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