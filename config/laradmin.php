<?php

return array(
	
    /*
     |--------------------------------------------------------------------------
     | Laradmin Settings
     |-------------------------------------------------------------------------
     |
     | Laradmin debug is enabled by default, when debug is set to true in app.php.
     |
     */

    'enabled' => config('app.debug'),

   	/*
	 |--------------------------------------------------------------------------
	 | 
	 |--------------------------------------------------------------------------
	 |
	 | Project information
	 |
	 */

	'project' => array(
		'name' => 'Laradmin',
		'description' => 'Laravel Admin will help you getting started with Laravel 5',
		'author' => 'Ismail Sabry',
	),

	/*
	 |--------------------------------------------------------------------------
	 | Left Menus
	 |--------------------------------------------------------------------------
	 |
	 | Left Menus Items
	 |
	 */
	'left_menus_mode' => array(
		'icon' => true,
		'label' => true,
	),

	'left_menus' => array(
		'dashboard' => array(
			'auth'  => true,
			'href'  => '/dashboard',
			'icon'  => '<i class="fa fa-dashboard"></i>',
			'label' => 'Dashboard',
		),
		'users' => array(
			'auth'  => true,
			'permissions' => ['admin'],
			'href'  => '/users',
			'icon'  => '<i class="fa fa-users"></i>',
			'label' => 'Users',
		),
		'clients' => array(
			'auth'  => true,
			'permissions' => ['admin', 'manager'],
			'href'  => '/clients',
			'icon'  => '<i class="fa fa-list-alt"></i>',
			'label' => 'Clients',
		),
		'services' => array(
			'auth'  => true,
			'permissions' => ['admin', 'manager'],
			'href'  => '/services',
			'icon'  => '<i class="fa fa-tags"></i>',
			'label' => 'Services',
		),

	),

	/*
	 |--------------------------------------------------------------------------
	 | Right Menus
	 |--------------------------------------------------------------------------
	 |
	 | Right Menus Items
	 |
	 */
	'right_menus_mode' => array(
		'icon' => true,
		'label' => true,
	),

	'right_menus' => array(
		// 'settings' => array(
		// 	'auth'  => true,
		// 	'href'  => '/settings',
		// 	'icon'  => '<i class="fa fa-sliders"></i>',
		// 	'label' => 'Settings',
		// ),
		'profile' => array(
			'auth'  => true,
			'permissions' => ['admin', 'manager', 'user'],
			'href'  => '/profile',
			'icon'  => '<i class="fa fa-user"></i>',
			'label' => 'Profile',
		),
		'logout' => array(
			'auth'  => true,
			'permissions' => ['admin', 'manager', 'user'],
			'href'  => '/auth/logout',
			'icon'  => '<i class="fa fa-power-off"></i>',
			'label' => 'Logout',
		),
		'login' => array(
			'auth'  => false,
			'href'  => '/auth/login',
			'icon'  => '<i class="fa fa-external-link"></i>',
			'label' => 'Login',
		),
		'register' => array(
			'auth'  => false,
			'href'  => '/auth/register',
			'icon'  => '<i class="fa fa-ioxhost"></i>',
			'label' => 'Register',
		),
	),

);
