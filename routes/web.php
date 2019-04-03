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

// 메인
Route::get('/', 'MainController@index');

// 쿠폰발행
Route::get('/publish', 'MainController@publish');

// 쿠폰 리스트
Route::get('/list', 'MainController@list');

// 쿠폰 사용
Route::get('/use', 'MainController@use');

// 쿠폰 통계
Route::get('/stat', 'MainController@stat');

// 쿠폰 중복 조회
Route::get('/check', 'MainController@checkCoupon');

// TEST
Route::get('/test', 'MainController@test');
