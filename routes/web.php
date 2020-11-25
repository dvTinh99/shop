<?php

use Illuminate\Support\Facades\Route;

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
/**
 * route admin
 * 
 */
Route::get('admin',[
    'as'=>'adminIndex',
    'uses'=> 'App\Http\Controllers\AdminController@AdminIndex'
]);
Route::get('adminInsert',[
    'as'=>'insert',
    'uses'=>'App\Http\Controllers\AdminController@AdminInsert'
]);
Route::post('AdminSave',[
    'as'=>'save',
    'uses'=>'App\Http\Controllers\AdminController@AdminSave'
]);
Route::post('AdminSave2',[
    'as'=>'save2',
    'uses'=>'App\Http\Controllers\AdminController@AdminSaveAfterEdit'
]);
Route::get('AdminEdit/{id}',[
    'as'=>'edit',
    'uses'=>'App\Http\Controllers\AdminController@AdminEdit'
]);
Route::get('AdminDelete/{id}',[
    'as'=>'delete',
    'uses'=>'App\Http\Controllers\AdminController@AdminDelete'
]);
Route::get('thong-ke',[
    'as'=>'thongke',
    'uses'=>'App\Http\Controllers\AdminController@AdminThongKe'
]);
Route::post('trang-thai',[
    'as'=>'trangthai',
    'uses'=>'App\Http\Controllers\AdminController@AdminTrangthai'
]);

 //////////////
Route::get('/',[
    'as'=>'trang-chu',
    'uses'=>'App\Http\Controllers\PageController@getIndex'
]);
Route::get('index',[
    'as'=>'trang-chu',
    'uses'=>'App\Http\Controllers\PageController@getIndex'
]);
Route::get('loai-san-pham/{type}',[
    'as'=>'loaisanpham',
    'uses'=>'App\Http\Controllers\PageController@getLoaiSp'
]);
Route::get('chi-tiet-san-pham/{id}',[
    'as'=>'chitietsanpham',
    'uses'=>'App\Http\Controllers\PageController@getChitiet'
]);
Route::get('lien-he',[
    'as'=>'lienhe',
    'uses'=>'App\Http\Controllers\PageController@getLienHe'
]);
Route::get('gioi-thieu',[
    'as'=>'gioithieu',
    'uses'=>'App\Http\Controllers\PageController@getGioiThieu'
]);
Route::get('add-to-cart/{id}',[
    'as'=>'themgiohang',
    'uses'=>'App\Http\Controllers\PageController@getAddToCart'
]);
Route::get('del-cart/{id}',[
    'as'=>'xoagiohang',
    'uses'=>'App\Http\Controllers\PageController@getDelItemCart'
]);
Route::get('thanh-toan',[
    'as'=>'thanhtoan',
    'uses'=>'App\Http\Controllers\PageController@getThanhToan'
]);
Route::post('dat-hang',[
    'as'=>'dathang',
    'uses'=>'App\Http\Controllers\PageController@postCheckout'
]);
// Route::get('dat-hang2',[
//     'as'=>'dathang2',
//     'uses'=>'App\Http\Controllers\PageController@postCheckout'
// ]);

Route::get('dang-nhap',[
    'as'=>'login',
    'uses'=>'App\Http\Controllers\PageController@getLogin'
]);
Route::post('dang-nhap',[
    'as'=>'login',
    'uses'=>'App\Http\Controllers\PageController@postLogin'
]);

Route::get('dang-ki',[
    'as'=>'signin',
    'uses'=>'App\Http\Controllers\PageController@getSignin'
]);
Route::post('dang-ki',[
    'as'=>'signin',
    'uses'=>'App\Http\Controllers\PageController@postSignin'
]);
Route::get('dang-xuat',[
    'as'=>'logout',
    'uses'=>'App\Http\Controllers\PageController@postLogout'
]);
Route::get('search',[
    'as'=>'search',
    'uses'=>'App\Http\Controllers\PageController@getSearch'
]);
///////////////////////////////
Route::get('doanh-thu',[
    'as'=>'doanhthu',
    'uses'=>'App\Http\Controllers\AdminController@AdminDoanhThu'
]);

Route::get('sp-ban-chay',[
    'as'=>'spbanchay',
    'uses'=>'App\Http\Controllers\AdminController@AdminBanChay'
]);
Route::get('sp-ban-cham',[
    'as'=>'spbancham',
    'uses'=>'App\Http\Controllers\AdminController@AdminBanCham'
]);
Route::get('doanh-thu-theo-tuan',[
    'as'=>'tuan',
    'uses'=>'App\Http\Controllers\AdminController@AdminTuan'
]);
Route::get('doanh-thu-theo-thang',[
    'as'=>'thang',
    'uses'=>'App\Http\Controllers\AdminController@AdminThang'
]);

