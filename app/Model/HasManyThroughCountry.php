<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HasManyThroughCountry extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'HasManyThroughCountry';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'HasManyThroughCountryId';

    /**
     * 取得該國家的所有文章。
     */
    public function Posts() {
        return $this->hasManyThrough(
            'App\Model\OneToManyPost',//最終關聯Model
            'App\Model\User', //中間Model
            'CountryId', //自己的關聯外鍵
            'UserId', //中間表的關聯外鍵
            'HasManyThroughCountryId', //自己的關聯主鍵
            'id' //中間表的關聯主鍵
        );
    }
}
