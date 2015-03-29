<?php
/**
 * @package   Laradmin
 * @author    Ismail SABRY <ismail@sabry.fr>
 * @copyright Copyright (c) Ismail SABRY
 */
namespace Isabry\Laradmin\Models;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'menus';

	/**------------------------------------------------------------------------
	 * Get the Left Menu.
	 *
	 * @return left menu 
	 */
	public static function getMenus($auth, $side='left')
	{
		// $menus = DB::table('menus');
		// 			->where('auth', '=', $auth)
		// 			->where('side', '=', $side)
		// 			->get();

		$menus = parent::where('auth', '=', $auth)->where('side', '=', $side);

		return $menus;
	}

}