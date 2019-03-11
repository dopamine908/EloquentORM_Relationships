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
}
