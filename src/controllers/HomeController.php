<?php
/**
 * @package   Laradmin
 * @author    Ismail SABRY <ismail@sabry.fr>
 * @copyright Copyright (c) Ismail SABRY
 */
namespace Isabry\Laradmin\Controllers;

use Auth;
use View;
use Debugbar;

class HomeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		// $this->middleware('roles');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('laradmin::home.index');
	}

	/**
	 * Show the user profile.
	 *
	 * @return Response
	 */
	public function profile()
	{
		// $menus = AppMenu::getMenus('left');
		// Debugbar::info($menus);

		$user = Auth::user();

		return View::make('laradmin::users.user')->with('user', $user );
	}

}