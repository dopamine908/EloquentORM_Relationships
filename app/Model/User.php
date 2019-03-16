<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * 取得與使用者有關的電話記錄。
     */
    public function OneToOnePhone() {
        return $this->hasOne(
            'App\Model\OneToOnePhone',
            'UserId', //OneYoOnePhone.UserId
            'id' // users.id
        );
    }

    /**
     * 取得與使用者有關的電話記錄。
     * 若電話為空的時候
     * 可以返回預設的資料
     */
    public function OneToOnePhoneWithDefault() {
        return $this->hasOne(
            'App\Model\OneToOnePhone',
            'UserId', //OneYoOnePhone.UserId
            'id' // users.id
        )->withDefault(['Phone' => '3345678']);
    }

    /**
     * 取得與使用者有關的電話記錄。
     * 若電話為空的時候
     * 可以用Closure返回預設的資料
     */
    public function OneToOnePhoneWithDefaultClosure() {
        return $this->hasOne(
            'App\Model\OneToOnePhone',
            'UserId', //OneYoOnePhone.UserId
            'id' // users.id
        )->withDefault(function ($OneToOnePhone) {
            $OneToOnePhone->Phone = '3345678';
        });
    }

    /**
     * 屬於該使用者的身份。
     */
    public function ManyToManyRole() {
        /*
         * users 跟 ManyToManyRole 表是多對多關係
         * 中間表為 ManyToManyRoleUser 表
         * related 是被關聯Model，
         * table 是中間表，
         * foreignPivotKey 是中間表中父模型外鍵名，
         * relatedPivotKey 是中間表中子模型外鍵名，
         * parentKey 是父模型主鍵名，
         * relatedKey 是子模型主鍵名，
         * relation 是關係名。
         */
        return $this->belongsToMany(
            'App\Model\ManyToManyRole', //最終關聯Model
            'ManyToManyRoleUser', // 中間表
            'UserId', //ManyToManyRoleUser.UserId
            'ManyToManyRoleId', //ManyToManyRoleUser.ManyToManyRoleId
            'id', //usees.id
            'ManyToManyRoleId' //ManyToManyRoleUser.ManyToManyRoleId
        )
            ->withPivot('ManyToManyRoleUserId', 'created_at')
            ->withTimestamps();

    }

    /*
     * 取得中介表欄位
     */
    public function ManyToManyRoleWithPivotColumn() {
        return $this->belongsToMany(
            'App\Model\ManyToManyRole', //最終關聯Model
            'ManyToManyRoleUser', // 中間表
            'UserId', //ManyToManyRoleUser.UserId
            'ManyToManyRoleId', //ManyToManyRoleUser.ManyToManyRoleId
            'id', //usees.id
            'ManyToManyRoleId' //ManyToManyRoleUser.ManyToManyRoleId
        )
            ->withPivot('ManyToManyRoleUserId', 'created_at') //欄位名稱
            ->withTimestamps(); //時間欄位
    }


    /*
     * 自訂 中介表 名稱
     */
    public function ManyToManyRolePivotName() {
        return $this->belongsToMany(
            'App\Model\ManyToManyRole', //最終關聯Model
            'ManyToManyRoleUser', // 中間表
            'UserId', //ManyToManyRoleUser.UserId
            'ManyToManyRoleId', //ManyToManyRoleUser.ManyToManyRoleId
            'id', //usees.id
            'ManyToManyRoleId' //ManyToManyRoleUser.ManyToManyRoleId
        )
            ->as('RoleUser')
            ->withPivot('ManyToManyRoleUserId');
    }

    /*
     * 透過中介表來篩選關聯
     */
    public function ManyToManyRoleWherePivot() {
        return $this->belongsToMany(
            'App\Model\ManyToManyRole', //最終關聯Model
            'ManyToManyRoleUser', // 中間表
            'UserId', //ManyToManyRoleUser.UserId
            'ManyToManyRoleId', //ManyToManyRoleUser.ManyToManyRoleId
            'id', //usees.id
            'ManyToManyRoleId' //ManyToManyRoleUser.ManyToManyRoleId
        )
            ->wherePivot('ManyToManyRoleId', '=', 3);
    }

    /*
     * 透過中介表來篩選關聯
     */
    public function ManyToManyRoleWherePivotIn() {
        return $this->belongsToMany(
            'App\Model\ManyToManyRole', //最終關聯Model
            'ManyToManyRoleUser', // 中間表
            'UserId', //ManyToManyRoleUser.UserId
            'ManyToManyRoleId', //ManyToManyRoleUser.ManyToManyRoleId
            'id', //usees.id
            'ManyToManyRoleId' //ManyToManyRoleUser.ManyToManyRoleId
        )
            ->wherePivotIn('ManyToManyRoleId', [3,2]);
    }
}
