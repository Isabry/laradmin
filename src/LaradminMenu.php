<?php
/**
 * Laravel Service Provider for the OAuth 2.0 Server
 *
 * @package   isabry/openidc-client
 * @author    Isamil SABRY <ismail@sabry.fr>
 * @copyright Copyright (c) Isamil SABRY
 */
namespace Isabry\Laradmin;

use Log;
use Auth;
use DB;
use Debugbar;
use Isabry\Laradmin\Models\Menu;

class LaradminMenu
{
	/**
	* Create a new OpenIDConnect instance
	*/
	public function __construct()
	{
	}

	/**------------------------------------------------------------------------
	 * Get Menu.
	 *
	 * @m_returnstatus(conn, identifier) menu 
	 */
	public static function getMenus($side='left')
	{
		$auth  = Auth::check();

		$menus = Menu::getMenus($auth, $side)->get();

		Debugbar::info($menus);

		// $menus = Menu::where(function ($query) use ($auth, $side) {
		// 	$query->where('auth', '=', $auth)
		// 		  ->Where('side', '=', $side);
		// });

		return $menus;
	}

}
