<?php

namespace App\Http\Controllers;

use App\Model\ManyToManyRole;
use Illuminate\Http\Request;

use App\Model\User;
use App\Model\OneToOnePhone;
use App\Model\OneToManyPost;
use App\Model\OneToManyComment;
use App\Model\HasManyThroughCountry;

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
}
