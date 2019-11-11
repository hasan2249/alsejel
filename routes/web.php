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

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

// Controller: userController -----------
Route::get('/user/{id}', 'userController@user_page');

Route::get('/users', 'userController@users_page'); 
//---------------------------------------

// Controller: TaskController -----------

Route::get('/tasks', 'TaskController@tasks_page'); 

Route::get('/task/{id}', 'TaskController@task_page');

Route::post('/task/{id}', 'TaskController@logwork');
//---------------------------------------
