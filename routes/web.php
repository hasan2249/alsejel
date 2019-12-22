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
Route::post('/user/{id}/load_user_activities_data', 'userController@load_user_activities_data');
Route::get('/users', 'userController@users_page');

//---------------------------------------

// Controller: TaskController -----------

Route::get('/tasks', 'TaskController@tasks_page');

Route::get('/task/{id}', 'TaskController@task_page');

Route::get('/delete/{id}', 'TaskController@deleteLogwork');

Route::post('/task/{id}', 'TaskController@logwork');

Route::post('/editLogwork/{id}', 'TaskController@editLogwork');

Route::get('/task/{id}/join', 'TaskController@join');
Route::post('/task/{id}/join', 'TaskController@join');

Route::get('/task/{id}/left', 'TaskController@left');
Route::post('/task/{id}/left', 'TaskController@left');
Route::post('/task/{id}/load_task_activities_data', 'TaskController@load_task_activities_data');
// Task -> Comment routing
Route::post('/AddComment/{id}', 'TaskController@AddComment');
Route::post('/editComment/{id}', 'TaskController@editComment');
Route::get('/deleteComment/{id}', 'TaskController@deleteComment');
//---------------------------------------

// Buckup database
Route::post('/backupDB', 'TaskController@backupDB')->name('Buckup');
// --------------------------------------


// Controller: LoginController -----------
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
//change password
Route::get('change-password', 'userController@index');
Route::post('change-password', 'userController@store')->name('change.password');
Route::post('change-image', 'userController@updateProfile')->name('change.image');

// export report as excel file ---------------
Route::get('importExport', 'ExcelController@importExport');
Route::get('downloadExcel', 'ExcelController@downloadExcel');
Route::get('allToExcel/{type}', 'ExcelController@allToExcel');
Route::get('display', 'ExcelController@display');


// charts --------------------------
Route::post('/charts', 'WorkDurationControler@chartOfTask');
Route::get('/charts', 'WorkDurationControler@showChartPage');

