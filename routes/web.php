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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('books','BooksController');
Route::resource('permissions','PermissionsController');
Route::resource('roles','RolesController');
Route::get('/allperms','RolesPermissionController@getAllPerms');
Route::post('/assign','RolesPermissionController@assignRoles');
Route::get('/users','UserController@index');
Route::post('/toggle','RolesPermissionController@toggleUserRole');
