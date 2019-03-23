<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class PolymorphicRelationPost extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'PolymorphicRelationPost';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'PolymorphicRelationPostId';

    /**
     * 取得Post對應的Comment
     */
    public function PolymorphicRelationsComment() {
        return $this->morphMany(
            'App\Model\PolymorphicRelationsComment', //relation
            null, //name
            'CommentType', //關聯對象表在分case的欄位
            'CommentTargetId', //關聯對象表的關聯Id
            'PolymorphicRelationPostId' //關聯出去的key
        );
    }
}
