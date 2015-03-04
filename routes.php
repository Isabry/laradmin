<?php

/*
|------------------------------------------------------------------------------
| Application Routes
|------------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::get('dashboard', 'HomeController@index');
Route::get('profile', 'HomeController@profile');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//-----------------------------------------------------------------------------
// Users
Route::group(['permissions' => ['admin', 'manager']], function () {
	Route::resource('users', 'UsersController');
	Route::post('users/{userid}/enable', 'UsersController@enable');
});


//-----------------------------------------------------------------------------
// Clients
Route::resource('clients', 'ClientsController');
// Route::post('clients/{clientid}/enable', 'ClientsController@enable');

//-----------------------------------------------------------------------------
// Services
Route::resource('services', 'ServicesController');
// Route::post('services/{serviceid}/enable', 'ServicesController@enable');
