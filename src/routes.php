<?php

Route::group(['middleware' => 'auth'], function() {
	// Route::get('/',       'Isabry\Laradmin\Controllers\HomeController@index');
	// Route::get('home',    'Isabry\Laradmin\Controllers\HomeController@index');
	Route::get('profile', 'Isabry\Laradmin\Controllers\HomeController@profile');
});

//-----------------------------------------------------------------------------
// Users
Route::group(['permissions' => ['admin', 'manager']], function () {
	Route::resource('users', 'Isabry\Laradmin\Controllers\UsersController');
	Route::post('users/{userid}/enable', [
		'uses' => 'Isabry\Laradmin\Controllers\UsersController@enable',
		'as' => 'users.enable',
	]);
});

Route::controllers([
	'auth'     => 'Isabry\Laradmin\Controllers\Auth\AuthController',
	'password' => 'Isabry\Laradmin\Controllers\Auth\PasswordController',
]);


// $router->get('awesome-sauce/{id}', [
//     'uses' => 'App\Http\Controllers\AwesomeController@sauce',
//     'as' => 'sauce',
//     'middleware' => [],
//     'where' => [],
//     'domain' => NULL,
// ]);