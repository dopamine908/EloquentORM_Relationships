<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\User;
use App\Model\OneToOnePhone;
use App\Model\OneToManyPost;
use App\Model\OneToManyComment;

class RelationshipController extends Controller
{
    /**
     * Eloquent一對一關聯用法
     */
    public function OneToOne() {
        $user = User::find(1);
        dump($user->OneToOnePhone);

        $phone = OneToOnePhone::find(2);
        dump($phone->users);

        $user = User::find(3);
        dump($user->OneToOnePhoneWithDefault);

        $phone = OneToOnePhone::find(4);
        dump($phone->usersWithDefault);

        $user = User::find(3);
        dump($user->OneToOnePhoneWithDefaultClosure);

        $phone = OneToOnePhone::find(4);
        dump($phone->usersWithDefaultClosure);
    }

    /**
     * Eloquent一對多關聯用法
     */
    public function OneToMany() {
        /*
         * hasMany
         */
        $post = OneToManyPost::find(1);
        dump($post->OneToManyComment);

        /*
         * hasMany 條件下在關聯表
         */
        $comment = OneToManyPost::find(1)->OneToManyComment()->where('Comment', '=', 'Eda Towne')->get();
        dump($comment);

        /*
         * belongsTo
         */
        $comment = OneToManyComment::find(1);
        $post = $comment->OneToManyPost;
        dump($comment, $post);
    }
}
