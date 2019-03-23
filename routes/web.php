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

