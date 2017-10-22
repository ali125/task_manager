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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('dashboard');


// Projects Root
Route::get('/projects', 'ProjectsController@index')->name('projects');
Route::get('/archive', 'ProjectsController@archive')->name('projects_archive');

Route::get('/projects/add', 'ProjectsController@new')->name('new_project');
Route::post('/projects/add', 'ProjectsController@new')->name('add_project');
Route::get('/projects/edit/{project_id}', 'ProjectsController@edit')->name('edit_project');
Route::post('/projects/edit/{project_id}', 'ProjectsController@edit')->name('edit_project');
Route::get('/projects/delete/{project_id}', 'ProjectsController@delete')->name('delete_project');
Route::get('/projects/view/{project_id}', 'ProjectsController@show')->name('view_project');
Route::get('/projects/change_status/{project_id}', 'ProjectsController@change_status')->name('change_status_project');



// Tasks Root
Route::get('/tasks/all', 'TaskController@index')->name('all_tasks');
Route::get('/tasks/{project_id}', 'TaskController@list')->name('tasks');
Route::get('/tasks/create', 'TaskController@create')->name('create_task');
Route::get('/tasks/new/{project_id}', 'TaskController@add')->name('new_task');
Route::post('/tasks/new/{project_id}', 'TaskController@add')->name('add_task');
Route::post('/task/edit/{task_id}', 'TaskController@edit')->name('edit_task');
Route::post('/task/delete/{task_id}', 'TaskController@delete')->name('delete_task');
Route::get('/task/{task_id}', 'TaskController@show')->name('view_task');
Route::get('/task/edit/{task_id}', 'TaskController@edit_task')->name('edit_task');
Route::post('/task/edit/{task_id}', 'TaskController@edit_task')->name('update_task');

Route::post('/task/{task_id}', 'TaskController@new_message')->name('new_message_task');


// Users Root
Route::get('/user/new/{project_id}', 'UserController@add')->name('new_user');
Route::post('/user/new/{project_id}', 'UserController@add')->name('add_user');

Route::get('/settings', 'UserController@edit')->name('settings');
Route::post('/settings', 'UserController@edit')->name('user_update');


// File Manger
Route::get('/files', 'FileController@index')->name('file_manager');


// Settings
Route::get('/projects/structure', 'ProjectsController@structure')->name('projects_structure');
Route::post('/projects/structure', 'ProjectsController@structure')->name('set_projects_structure');
Route::get('/projects/structure/{project_id}', 'ProjectsController@edit_structure')->name('edit_structure_project');
Route::post('/projects/structure/{project_id}', 'ProjectsController@edit_structure')->name('update_structure_project');
