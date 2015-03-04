<?php
/**
 * @package   Laradmin
 * @author    Ismail SABRY <ismail@sabry.fr>
 * @copyright Copyright (c) Ismail SABRY
 */
namespace App\Http\Controllers;

use Auth;
use View;

class HomeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('roles');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home.index');
	}

	/**
	 * Show the user profile.
	 *
	 * @return Response
	 */
	public function profile()
	{
		$user = Auth::user();

		return View::make('users.user')->with('user', $user );
	}

}