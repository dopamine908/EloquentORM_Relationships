<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PolymorphicRelastionsVideo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'PolymorphicRelastionsVideo';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'PolymorphicRelastionsVideoId';

    /**
     * 取得Video對應的Comment
     */
    public function PolymorphicRelationsComment() {
        return $this->morphMany(
            'App\Model\PolymorphicRelationsComment', //relation
            null, //name
            'CommentType', //關聯對象表在分case的欄位
            'CommentTargetId', //關聯對象表的關聯Id
            'PolymorphicRelastionsVideoId' //關聯出去的key
        );
    }
}
