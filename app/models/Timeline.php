<?php

use \Michelf\MarkdownExtra;

/**
 * Timeline
 */
class Timeline extends BaseModel
{
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'timeline';

    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;


    /**
     * 模型对象关系：招聘者
     * @return object User
     */
    public function timeline()
    {
        return $this->belongsTo('User', 'user_id');
    }


}