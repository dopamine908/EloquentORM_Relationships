<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OneToManyPost extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'OneToManyPost';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'OneToManyPostId';

    /**
    * 取得部落格文章的評論
    */
    public function OneToManyComment() {
        return $this->hasMany(
            'App\Model\OneToManyComment', //related
            'OneToManyPostId', //OneToManyComment.OneToManyPostId
            'OneToManyPostId' //OneToManyPost.OneToManyPostId
        );
    }
}
