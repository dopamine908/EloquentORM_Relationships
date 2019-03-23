<?php

namespace App\Http\Controllers;

use App\Model\ManyToManyRole;
use App\Model\PolymorphicRelationsComment;
use Illuminate\Http\Request;

use App\Model\User;
use App\Model\OneToOnePhone;
use App\Model\OneToManyPost;
use App\Model\OneToManyComment;
use App\Model\HasManyThroughCountry;
use App\Model\PolymorphicRelationPost;
use App\Model\PolymorphicRelastionsVideo;

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

    /**
     * Eloquent 多對多關聯用法
     */
    public function ManyToMany() {
        /**
         * 屬於該使用者的身份。
         */
        $user = User::find(1);
        dump($user->ManyToManyRole);
        $user = User::find(2);
        dump($user->ManyToManyRole);
        $user = User::find(3);
        dump($user->ManyToManyRole);

        /**
         * 屬於該身份的使用者們。
         */
        $role = ManyToManyRole::find(1);
        dump($role->User);
        $role = ManyToManyRole::find(2);
        dump($role->User);
        $role = ManyToManyRole::find(3);
        dump($role->User);

        /*
         * 取得中介表欄位
         */
        foreach ($user->ManyToManyRole as $role) {
            dump($role->pivot);
            dump($role->pivot->ManyToManyRoleUserId);
        }

        /*
         * 自訂 中介表 名稱
         */
        foreach ($user->ManyToManyRolePivotName as $role) {
            dump($role->RoleUser);
            dump($role->RoleUser->ManyToManyRoleUserId);
        }

        /*
         * 透過中介表來篩選關聯
         */
        foreach ($user->ManyToManyRoleWherePivot as $role) {
            dump($role->Role);
        }
        foreach ($user->ManyToManyRoleWherePivotIn as $role) {
            dump($role->Role);
        }
    }

    /**
     * Eloquent 遠層一對多關聯用法
     */
    public function HasManyThrough() {
        $country = HasManyThroughCountry::find(1);
        dump($country->Posts);
    }

    /**
     * Eloquent 多型關聯用法
     */
    public function PolymorphicRelations() {
        /**
         * 取得CommenetType對應值所關聯的Model
         */
        $comment = PolymorphicRelationsComment::find(1);
        dump($comment->CommentType123()); //可看MorphTo內容
        $comment = PolymorphicRelationsComment::find(2);
        dump($comment->CommentType123); //取得對應Model

        /**
         * 取得Post對應的Comment
         */
        $comment = PolymorphicRelationPost::find(1);
        dump($comment->PolymorphicRelationsComment()); //可看MorphTo內容
        dump($comment->PolymorphicRelationsComment); //取得對應Model

        /**
         * 取得Video對應的Comment
         */
        $comment = PolymorphicRelastionsVideo::find(1);
        dump($comment->PolymorphicRelationsComment()); //可看MorphTo內容
        dump($comment->PolymorphicRelationsComment); //取得對應Model
    }
}
