<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/', 'HomeController@index');
Route::get('/messages', 'HomeController@messages');
Route::post('/create_user', 'HomeController@create_user');
Route::post('users/edit', 'HomeController@edit');
Route::get('users/{id}', 'HomeController@show')->where('id','\d+');
Route::get('/users', 'HomeController@users');
Route::post('users/delete', 'HomeController@delete');
//Route::get('/', array('before' => 'auth','uses'=>'HomeController@index'));
Route::get('/tasks', array('before' => 'auth','uses'=>'TasksController@tasks'));
Route::get('/tasks/new', array('before' => 'auth|check_roles','uses'=>'TasksController@newtask'));
Route::post('tasks/create', 'TasksController@save');
Route::get('tasks/{id}', array('before' => 'auth|check_roles','uses'=>'TasksController@show'))->where('id','\d+');
Route::post('tasks/update', 'TasksController@edit');
Route::post('tasks/update_all', 'TasksController@edit_all');
Route::post('tasks/delete', 'TasksController@delete');
Route::get('/login', 'HomeController@login');
Route::get('/logout', 'HomeController@logout');
Route::post('/auth', 'HomeController@auth');
Route::post('/mail', 'HomeController@mail');