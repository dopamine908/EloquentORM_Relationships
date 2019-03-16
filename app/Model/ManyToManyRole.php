<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ManyToManyRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ManyToManyRole';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ManyToManyRoleId';

    /**
     * 屬於該身份的使用者們。
     */
    public function User() {
        /*
         * ManyToManyRole 跟 users 表是多對多關係
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
          'App\Model\User', //最終關聯Model
          'ManyToManyRoleUser', // 中間表
          'ManyToManyRoleId', //ManyToManyRoleUser.ManyToManyRoleId
          'UserId', //ManyToManyRoleUser.UserId
          'ManyToManyRoleId', //ManyToManyRoleUser.ManyToManyRoleId
          'id' //usees.id
        );
    }
}
