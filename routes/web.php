<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Eloquent一對一關聯用法
|--------------------------------------------------------------------------
*/
Route::get('一對一', 'RelationshipController@OneToOne');

/*
|--------------------------------------------------------------------------
| Eloquent一對多關聯用法
|--------------------------------------------------------------------------
*/
Route::get('一對多', 'RelationshipController@OneToMany');

/*
|--------------------------------------------------------------------------
| Eloquent多對多關聯用法
|--------------------------------------------------------------------------
*/
Route::get('多對多', 'RelationshipController@ManyToMany');

/*
|--------------------------------------------------------------------------
| Eloquent遠層一對多
|--------------------------------------------------------------------------
*/
Route::get('遠層一對多', 'RelationshipController@HasManyThrough');

/*
|--------------------------------------------------------------------------
| Eloquent多行關聯
|--------------------------------------------------------------------------
*/
Route::get('多行關聯', 'RelationshipController@PolymorphicRelations');

/*
|--------------------------------------------------------------------------
| Eloquent多對多的多型關聯
|--------------------------------------------------------------------------
*/
Route::get('多對多的多型關聯', 'RelationshipController@ManyToManyPolymorphicRelations');

/*
|--------------------------------------------------------------------------
| 將查詢條件鏈結到關聯查詢上
|--------------------------------------------------------------------------
*/
Route::get('查詢關聯', 'RelationshipController@whereRelation');

/*
|--------------------------------------------------------------------------
| 查詢存在or未存在的關聯
|--------------------------------------------------------------------------
*/
Route::get('查詢存在or未存在的關聯', 'RelationshipController@whereHasRelation');

/*
|--------------------------------------------------------------------------
| 計算關聯
|--------------------------------------------------------------------------
*/
Route::get('計算關聯', 'RelationshipController@countRelation');

/*
|--------------------------------------------------------------------------
| 預載入
|--------------------------------------------------------------------------
*/
Route::get('預載入', 'RelationshipController@eagerLoadRelation');

/*
|--------------------------------------------------------------------------
| 延遲預載入
|--------------------------------------------------------------------------
*/
Route::get('延遲預載入', 'RelationshipController@loadRelation');

/*
|--------------------------------------------------------------------------
| save方法
|--------------------------------------------------------------------------
*/
Route::get('save方法', 'RelationshipController@save');