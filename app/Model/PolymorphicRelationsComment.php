<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PolymorphicRelationsComment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'PolymorphicRelationsComment';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'PolymorphicRelationsCommentId';

    /**
     * 取得CommenetType對應值所關聯的Model
     */
    public function CommentType123() {
        return $this->morphTo(
            null, //name
            'CommentType', //關聯出去分case的欄位
            'PolymorphicRelationsCommentId' //關聯出去要參考的id
        );
    }
}
