<?php
/**
 * Users Table Seeder
 *
 * @package   Admin Laravel
 * @author    Ismail SABRY <ismail@sabry.fr>
 * @copyright Copyright (c) Ismail SABRY
 */

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class MenusTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('menus')->delete();

		$menus = [
			[
				'auth' => true,
				'href' => '/dashboard',
				'icon' => '<i class="fa fa-dashboard"></i>',
				'label' => 'Dashboard',
				'access_manager' => true,
				'access_user' => true,
				'side' => 'left',
			],
			[
				'auth' => true,
				'href' => '/users',
				'icon' => '<i class="fa fa-users"></i>',
				'label' => 'Users',
				'access_manager' => true,
				'access_user' => false,
				'side' => 'left',
			],
			[
				'auth' => true,
				'href'  => '/profile',
				'icon'  => '<i class="fa fa-user"></i>',
				'label' => 'Profile',
				'access_manager' => true,
				'access_user' => false,
				'side' => 'right',
			],
			[
				'auth' => true,
				'href'  => '/auth/logout',
				'icon'  => '<i class="fa fa-power-off"></i>',
				'label' => 'Logout',
				'access_manager' => true,
				'access_user' => true,
				'side' => 'right',
			],
			[
				'auth'  => false,
				'href'  => '/auth/login',
				'icon'  => '<i class="fa fa-external-link"></i>',
				'label' => 'Login',
				'access_manager' => true,
				'access_user' => true,
				'side' => 'right',
			],
			[
				'auth'  => false,
				'href'  => '/auth/register',
				'icon'  => '<i class="fa fa-ioxhost"></i>',
				'label' => 'Register',
				'access_manager' => true,
				'access_user' => true,
				'side' => 'right',
			],
		];

		DB::table('menus')->insert($menus);
	}
}
