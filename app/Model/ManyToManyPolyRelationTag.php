<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ManyToManyPolyRelationTag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ManyToManyPolyRelationTag';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ManyToManyPolyRelationTagId';

    /**
     * 取得持有該Tag的所有Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function Posts() {
        return $this->morphedByMany(
            'App\Model\ManyToManyPolyRelationPost', //relation
            /**
             * 底層寫死分case的欄位名稱的規則為
             * $name.'_type'
             * 所以欄位命名要遵循這個規則才可以使用
             * 此處分case的欄位名稱為TagType_type
             */
            $name = 'TagType', //中間表在分case的欄位名稱
            'ManyToManyPolyRelationTaggle', //中間表
            'TagId', //關聯到中間表的key欄位
            'TargetId', //中間表關聯出去的key欄位
            'ManyToManyPolyRelationTagId', //主表關聯出去的欄位
            'ManyToManyPolyRelationPostId' //目標表關聯的欄位
        );
    }

    /**
     * 取得持有該Tag的所有Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function Videos() {
        return $this->morphedByMany(
            'App\Model\ManyToManyPolyRelationVideo', //relation
            /**
             * 底層寫死分case的欄位名稱的規則為
             * $name.'_type'
             * 所以欄位命名要遵循這個規則才可以使用
             * 此處分case的欄位名稱為TagType_type
             */
            $name = 'TagType', //中間表在分case的欄位名稱
            'ManyToManyPolyRelationTaggle', //中間表
            'TagId', //關聯到中間表的key欄位
            'TargetId', //中間表關聯出去的key欄位
            'ManyToManyPolyRelationTagId', //主表關聯出去的欄位
            'ManyToManyPolyRelationVideoId' //目標表關聯的欄位
        );
    }
}
