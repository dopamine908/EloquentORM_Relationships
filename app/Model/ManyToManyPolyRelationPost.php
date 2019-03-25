<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ManyToManyPolyRelationPost extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ManyToManyPolyRelationPost';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ManyToManyPolyRelationPostId';

    /**
     * 取得該Post持有的所有Tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function PostAllTags() {
        return $this->morphToMany(
            'App\Model\ManyToManyPolyRelationTag', //relation
            /**
             * 底層寫死分case的欄位名稱的規則為
             * $name.'_type'
             * 所以欄位命名要遵循這個規則才可以使用
             * 此處分case的欄位名稱為TagType_type
             */
            $name = 'TagType', //中間表在分case的欄位名稱
            'ManyToManyPolyRelationTaggle', //中間表
            'TargetId', //關聯到中間表的key欄位
            'TagId', //中間表關聯出去的key欄位
            'ManyToManyPolyRelationPostId', //主表關聯出去的欄位
            'ManyToManyPolyRelationTagId', //目標表關聯的欄位
            false
        );
    }

}
