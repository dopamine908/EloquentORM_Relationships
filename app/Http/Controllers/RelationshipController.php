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
use App\Model\ManyToManyPolyRelationPost;
use App\Model\ManyToManyPolyRelationTag;
use App\Model\ManyToManyPolyRelationVideo;

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

    /**
     * Eloquent 多對多的多型關聯用法
     */
    public function ManyToManyPolymorphicRelations() {
        /**
         * Post所擁有的所有Tag
         */
        $post = ManyToManyPolyRelationPost::find(1);
        /**
         * 執行sql
         *
         * select `ManyToManyPolyRelationTag`.*,
         * `ManyToManyPolyRelationTaggle`.`TargetId` as `pivot_TargetId`,
         * `ManyToManyPolyRelationTaggle`.`TagId` as `pivot_TagId`
         * from `ManyToManyPolyRelationTag`
         * inner join `ManyToManyPolyRelationTaggle`
         * on `ManyToManyPolyRelationTag`.`ManyToManyPolyRelationTagId` = `ManyToManyPolyRelationTaggle`.`TagId`
         * where
         * `ManyToManyPolyRelationTaggle`.`TargetId` = 1 and
         * `ManyToManyPolyRelationTaggle`.`TagType_type` = 'Post'
         *
         */
        dump($post->PostAllTags()->toSql());
        dump($post->PostAllTags());
        dump($post->PostAllTags);

        /**
         * Video所擁有的所有Tag
         */
        $video = ManyToManyPolyRelationVideo::find(3);
        /**
         * 執行sql
         *
         * select `ManyToManyPolyRelationTag`.*,
         * `ManyToManyPolyRelationTaggle`.`TargetId` as `pivot_TargetId`,
         * `ManyToManyPolyRelationTaggle`.`TagId` as `pivot_TagId`
         * from `ManyToManyPolyRelationTag`
         * inner join `ManyToManyPolyRelationTaggle`
         * on `ManyToManyPolyRelationTag`.`ManyToManyPolyRelationTagId` = `ManyToManyPolyRelationTaggle`.`TagId`
         * where
         * `ManyToManyPolyRelationTaggle`.`TargetId` = 3 and
         * `ManyToManyPolyRelationTaggle`.`TagType_type` = 'Video'
         */
        dump($video->VideoAllTags()->toSql());
        dump($video->VideoAllTags());
        dump($video->VideoAllTags);

        /**
         * 執行sql
         *
         * select `ManyToManyPolyRelationPost`.*,
         * `ManyToManyPolyRelationTaggle`.`TagId` as `pivot_TagId`,
         * `ManyToManyPolyRelationTaggle`.`TargetId` as `pivot_TargetId`
         * from `ManyToManyPolyRelationPost`
         * inner join `ManyToManyPolyRelationTaggle`
         * on `ManyToManyPolyRelationPost`.`ManyToManyPolyRelationPostId` = `ManyToManyPolyRelationTaggle`.`TargetId`
         * where
         * `ManyToManyPolyRelationTaggle`.`TagId` = 2 and
         * `ManyToManyPolyRelationTaggle`.`TagType_type` = 'Post'
         */
        $tag = ManyToManyPolyRelationTag::find(2);
        dump($tag->Posts()->toSql());
        dump($tag->Posts());
        dump($tag->Posts);
        dump($tag->Videos);
    }

    /**
     * 將查詢條件鏈結到關聯查詢上
     */
    public function whereRelation() {
        $post = OneToManyPost::find(1);
        $comment = $post->OneToManyComment()->where('Comment', 'like', '%ro%')->get();
        dump($comment);
    }

    /**
     * 查詢存在or未存在的關聯
     */
    public function whereHasRelation() {
        /**
         * 取得Comment超過4個的Post
         */
        $post = OneToManyPost::has('OneToManyComment', '>', 4)->get();
        dump($post);

        /**
         * 取得Comment內容含有Prof的Post
         */
        $post = OneToManyPost::whereHas('OneToManyComment', function ($query){
            $query->where('Comment', 'like', '%Prof%');
        })->get();
        dump($post);

        /**
         * 取得不含Comment的Post
         */
        $post = OneToManyPost::doesntHave('OneToManyComment')->get();
        dump($post);

        /**
         * 取得Comment內容不含Prof的Post
         */
        $post = OneToManyPost::whereDoesntHave('OneToManyComment', function($query) {
            $query->where('Comment', 'like', '%Prof%');
        })->get();
        dump($post);
    }

    /**
     * 計算關聯
     */
    public function countRelation() {
        /**
         * 如果你想要從關聯中計算結果的數字，
         * 而不載入它們。
         * 可以使用 withCount 方法
         * 該方法會在你的結果模型上放置  {relation}_count 欄位
         * 其中{relation} 會轉換為小寫蛇行
         */
        $post = OneToManyPost::withCount('OneToManyComment')->get();
        dump($post);
        dump($post->pluck('one_to_many_comment_count'));

        /**
         * 可以對要count的欄位下條件
         */
        $post = OneToManyPost::withCount(['OneToManyComment' => function ($query) {
            $query->where('Comment', 'like', '%Prof%');
        }])->get();
        dump($post);
        dump($post->pluck('one_to_many_comment_count'));

        /**
         * 同一個欄位可以count多次
         * 如有用as 則會把結果模型放置的欄位名稱改為as 的值
         */
        $post = OneToManyPost::withCount([
            'OneToManyComment' => function ($query) {
                $query->where('Comment', 'like', '%Prof%');
            },
            'OneToManyComment as ContainC' => function ($query) {
                $query->where('Comment', 'like', '%C%');
            }
        ])->get();
        dump($post);
        dump($post->pluck('one_to_many_comment_count'));
        dump($post->pluck('ContainC'));
    }

    /**
     * 預載入
     */
    public function eagerLoadRelation() {
        /**
         * 預載入OneToManyComment資料
         * 執行了
         * select * from `OneToManyComment`
         * where
         * `OneToManyComment`.`OneToManyPostId`
         * in (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)
         *
         * 想預載入多個relation可以這樣寫
         * OneToManyPost::with(['Relation1', 'Relation2'])->get();
         */
        $post = OneToManyPost::with('OneToManyComment')->get();
        dump($post);

        /**
         * 只想載入relation的某些欄位的時候
         */
        $post = OneToManyPost::with('OneToManyComment:OneToManyPostId,Comment')->get();
        dump($post);

        /**
         * 可以對想要預載入的relation下條件
         */
        $post = OneToManyPost::with([
            'OneToManyComment' => function ($query) {
                $query->where('Comment', 'like', '%Prof%');
            }
        ])->get();
        dump($post);

        $post = OneToManyPost::with([
            'OneToManyComment' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ])->get();
        dump($post);
    }

    /**
     * 延遲預載入
     */
    public function loadRelation() {
        /**
         * 手動載入關聯模型
         */
        $post = OneToManyPost::all();
        dump($post);
        $post->load('OneToManyComment');
        dump($post);

        /**
         * 手動載入關聯模型（加條件）
         */
        $post = OneToManyPost::all();
        dump($post);
        $post->load([
            'OneToManyComment' => function ($query) {
                $query->where('Comment', 'like', '%Prof%');
            }
        ]);
        dump($post);

        /**
         * 如果有載入過的模型則不會在載入一次
         */
        $post = OneToManyPost::first();
        dump($post);
        $post->loadMissing('OneToManyComment');
        dump($post);
    }

    /**
     * save() 方法
     */
    public function save() {
        $post = OneToManyPost::find(1);
        $add_comment = new OneToManyComment();
        $add_comment->Comment = 'test_comment';
        /**
         * 呼叫 OneToManyComment 方法來取得關聯的實例
         * save 方法會自動在新的 OneToManyComment Model 中
         * 確實的新增 OneToManyPostId 值。
         */
        dump($post->OneToManyComment()->save($add_comment));

        $add_comment1 = new OneToManyComment();
        $add_comment1->Comment = 'test_comment_1';
        $add_comment2 = new OneToManyComment();
        $add_comment2->Comment = 'test_comment_2';
        /**
         * 儲存多筆關聯 Model
         */
        dump($post->OneToManyComment()->saveMany([
            $add_comment1,
            $add_comment2
        ]));
    }

    /**
     * create() 方法
     */
    public function create() {
        $post = OneToManyPost::find(1);
        /**
         * save 與 create 不同的地方在於
         * save 可以傳入一個完整的 Eloquent 模型實例
         * 但 create 只能傳入原生的 PHP 陣列
         *
         * 在使用 create 方法之前，請確定設定了批量賦值
         */
        dump($post->OneToManyComment()->create([
            'Comment' => 'test_comment_123'
        ]));

        /**
         * createMany 方法來建立多筆關聯模型
         */
        dump($post->OneToManyComment()->createMany([
            [
                'Comment' => 'test_comment_456'
            ],
            [
                'Comment' => 'test_comment_789'
            ]
        ]));
    }
}
