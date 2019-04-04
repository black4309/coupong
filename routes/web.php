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

// 로그인
Route::get('/login', 'MainController@login');

// 로그인 체크
Route::get('/login_check', 'MainController@login_check');

// 메인 페이지
Route::get('/main', 'MainController@main');

// 쿠폰발행
Route::get('/publish', 'CouponContorller@publish');

// 쿠폰 리스트
Route::get('/list', 'CouponContorller@list');

// 쿠폰 사용
Route::get('/use', 'CouponContorller@use');

// 쿠폰 통계
Route::get('/stat', 'CouponContorller@stat');

// 쿠폰 중복 조회
Route::get('/check', 'CouponContorller@checkCoupon');

// TEST
Route::get('/test', 'CouponContorller@test');


?>
