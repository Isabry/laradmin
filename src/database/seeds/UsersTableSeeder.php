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

class UsersTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('users')->delete();

		$datetime = Carbon::now();

		$users = [
			[
				'name' => 'admin',
				'email' => 'admin@sabry.fr',
				'password' => Hash::make('admin'),
				'role' => 'admin',
				'enable' => 1,
				'created_at' => $datetime,
				'updated_at' => $datetime,
			],
		];

		for($i=1; $i<15; $i++) {
			$ext = sprintf("%02d", $i);
			$users[] = [
				'name' => 'user'.$ext,
				'email' => 'user'.$ext.'@sabry.fr',
				'password' => Hash::make('user'),
				'role' => 'user',
				'enable' => 1,
				'created_at' => $datetime,
				'updated_at' => $datetime,
			];
		}

		DB::table('users')->insert($users);
	}
}
