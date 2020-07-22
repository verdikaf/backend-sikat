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

Route::get('/', function () {
    return view('welcome');
});

//pages
Route::get('/pages', 'PagesController@index');

//Login,Register,Logout User
Route::get('/login', 'UserController@login');
Route::post('/login/action', 'UserController@loginAction');
Route::get('/register', 'UserController@register');
Route::post('/register/action', 'UserController@registerAction');
Route::get('/logout', 'UserController@logout');

//user
Route::get('/user', 'UserController@userIndex');
Route::get('/user/add', 'UserController@userAdd');
Route::post('/user/add/save', 'UserController@userAddSave');
Route::get('/user/edit/{id}', 'UserController@userEdit');
Route::post('/user/edit/save', 'UserController@userEditSave');
Route::get('/user/detail/{id}', 'UserController@userDetail');

//logistik
Route::get('/logistik', 'LogistikController@index');
Route::get('/logistik/add', 'LogistikController@logistikAdd');
Route::post('/logistik/add/save', 'LogistikController@logistikAddSave');
Route::get('/logistik/edit/{id}', 'LogistikController@logistikEdit');
Route::post('/logistik/edit/save', 'LogistikController@logistikEditSave');
Route::get('/logistik/detail/{id}', 'LogistikController@logistikDetail');

//kategori logistik
Route::get('/kategori', 'KategoriLogistikController@index');
Route::get('/kategori/add', 'KategoriLogistikController@kategoriAdd');
Route::post('/kategori/add/save', 'KategoriLogistikController@kategoriAddSave');
Route::get('/kategori/edit/{id}', 'KategoriLogistikController@kategoriEdit');
Route::post('/kategori/edit/save', 'KategoriLogistikController@kategoriEditSave');
Route::get('/kategori/delete/{id}', 'KategoriLogistikController@kategoriDelete');

//supplier logistik
Route::get('/supplier', 'SupplierController@index');
Route::get('/supplier/add', 'SupplierController@supplierAdd');
Route::post('/supplier/add/save', 'SupplierController@supplierAddSave');
Route::get('/supplier/edit/{id}', 'SupplierController@supplierEdit');
Route::post('/supplier/edit/save', 'SupplierController@supplierEditSave');
Route::get('/supplier/delete/{id}', 'SupplierController@supplierDelete');

//laporan bencana
Route::get('/laporan', 'LaporanBencanaController@index');
Route::get('/laporan/add', 'LaporanBencanaController@laporanBencanaAdd');
Route::post('/laporan/add/save', 'LaporanBencanaController@laporanBencanaAddSave');
