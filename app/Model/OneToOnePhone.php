<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OneToOnePhone extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'OneToOnePhone';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'OneToOnePhoneId';

    /**
     * 取得擁有手機的使用者。
     */
    public function users() {
        return $this->belongsTo(
            'App\Model\User',
            'UserId', //OneToOnePhone.UserId
            'id' // users.id
        );
    }

    /**
     * 取得擁有手機的使用者。
     * 若使用者為空的時候
     * 可以返回預設的資料
     */
    public function usersWithDefault() {
        return $this->belongsTo(
            'App\Model\User',
            'UserId', //OneToOnePhone.UserId
            'id' // users.id
        )->withDefault(['name' => 'not found user']);
    }

    /**
     * 取得擁有手機的使用者。
     * 若使用者為空的時候
     * 可以用Closure返回預設的資料
     */
    public function usersWithDefaultClosure() {
        return $this->belongsTo(
            'App\Model\User',
            'UserId', //OneToOnePhone.UserId
            'id' // users.id
        )->withDefault(function ($users) {
            $users->name = 'not found user';
        });
    }
}
