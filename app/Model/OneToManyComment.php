<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OneToManyComment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'OneToManyComment';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'OneToManyCommentId';

    /**
     * 使用 create 需設定批量賦值
     */
    protected $fillable = ['Comment'];

    /**
     * 取得擁有該評論的文章。
     */
    public function OneToManyPost() {
        return $this->belongsTo(
            'App\Model\OneToManyPost', //related
            'OneToManyPostId', // OneToManyPost.OneToManyPostId
            'OneToManyPostId' //OneToManyComment.OneToManyPostId
        );
    }
}
