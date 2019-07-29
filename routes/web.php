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

Route::get('/','PageController@getTrangchu');

Auth::routes();

Route::get('admin', 'UserController@getDangnhapAdmin');
Route::post('admin', 'UserController@postDangnhapAdmin');
//Route::post('admin/dangnhap', 'UserController@postDangnhapAdmin');
Route::get('admin/dangxuat', 'UserController@DangxuatAdmin');

Route::group(['prefix'=>'admin', 'middleware'=>'adminLogin'], function(){
    Route::group(['prefix'=>'theloai'],function() {
        Route::get('danhsach', 'TheLoaiController@getDanhSach');
        Route::get('them', 'TheLoaiController@getThem');
        Route::post('them', 'TheLoaiController@postThem');
        Route::get('sua/{id}', 'TheLoaiController@getSua');
        Route::post('sua/{id}', 'TheLoaiController@postSua');
        Route::get('xoa/{id}', 'TheLoaiController@getXoa');
    });
    Route::group(['prefix'=>'loaitin'],function() {
        Route::get('danhsach', 'LoaitinController@getDanhSach');
        Route::get('them', 'LoaitinController@getThem');
        Route::post('them', 'LoaitinController@postThem');
        Route::get('sua/{id}', 'LoaitinController@getSua');
        Route::post('sua/{id}', 'LoaitinController@postSua');
        Route::get('xoa/{id}', 'LoaitinController@getXoa');

    });
    Route::group(['prefix'=>'tintuc'],function() {
        Route::get('danhsach', 'TintucController@getDanhSach');
        Route::get('them', 'TintucController@getThem');
        Route::post('them', 'TintucController@postThem');
        Route::get('sua/{id}', 'TintucController@getSua');
        Route::post('sua/{id}', 'TintucController@postSua');
        Route::get('xoa/{id}', 'TintucController@getXoa');
    });
    Route::group(['prefix'=>'comment'], function () {
        Route::get('xoa/{id}','TintucController@xoaComment');
    });

    Route::group(['prefix'=>'user'], function (){
        Route::get('danhsach', 'UserController@getDanhsach');
        Route::get('them', 'UserController@getThem');
        Route::post('them', 'UserController@postThem');
        Route::get('sua/{id}', 'UserController@getSua');
        Route::post('sua/{id}', 'UserController@postSua');
        Route::get('xoa/{id}', 'UserController@getXoa');
    });
    Route::group(['prefix'=>'ajax'], function(){
        Route::get('loaitin/{idTheLoai}', 'AjaxController@getLoaitin');
//        Route::post('loadmore/load_data', 'AjaxController@load_data')->name('loadmore.load_data');
    });
});
Route::get('trangchu', 'PageController@getTrangchu');
//Route::get('lienhe', 'PageController@getLienhe');
//Route::get('slide', 'PageController@getSlide');
Route::get('loaitin/{id}/{Ten}', 'PageController@getLoaitin');
Route::get('theloai/{id}/{Ten}', 'PageController@getTheLoai');

Route::get('chitiet/{id}/{Tieu}', 'PageController@getChiTiet');

//Route::get('dangnhap', 'PageController@getDangNhap');
//Route::post('dangnhap', 'PageController@postDangNhap');
//Route::get('dangxuat', 'PageController@getDangXuat');
Route::get('dangky', 'PageController@getDangKy');
Route::post('dangky', 'PageController@postDangKy');
Route::post('comment/{id}', 'PageController@postComment');
Route::get('timkiem', 'PageController@getTimKiem');
Route::get('suaUser/{id}', 'PageController@getsuaUser');
Route::post('suaUser/{id}', 'PageController@postsuaUser');
Route::get('check', 'LoadMoreController@check');
Route::get('/home', 'PageController@getTrangchu');
//Route::get('/trangchu', function () {
//    return view('welcome');
//});
Route::get('/loadmore', 'LoadMoreController@index');
Route::post('/loadmore/load_data', 'LoadMoreController@load_data')->name('loadmore.load_data');
Route::post('loadmore/load_loaitin','LoadMoreController@load_loaitin')->name('LoadLoaitin');

Route::post('loadmore/load_theloai','LoadMoreController@load_theloai')->name('LoadTheloai');

