<?php
/**
 * @package   Laradmin
 * @author    Ismail SABRY <ismail@sabry.fr>
 * @copyright Copyright (c) Ismail SABRY
 */
namespace App\Http\Controllers;

use Auth;
use App\User;
use View;
use Input;
use Session;
use Redirect;
use Hash;
use Debugbar;

class UsersController extends Controller {

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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if( Auth::check() ) {
			$users = User::paginate(10);
			// Debugbar::info("CheckRole/handle");
			return View::make('users.index')->with('users', $users);
		} else {
			Session::flash('error', 'You are not allowed to access Members list');
			return Redirect::intended('home');
		}	
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = new User;
		$user->role = "user";
		$user->enable = true;

		return View::make('users.user')
					->with('create', true)
					->with('user', $user );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User;

		$user->name     = Input::get('name');
		$user->email    = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->role     = Input::get('role');
		$user->enable   = Input::get('enable', false);
		
		$user->save();

		// Session::flash('info', '<pre>'.print_r($_POST, true).'</pre>');
		// Session::flash('error', 'You are not allowed to access this resource');
		Session::flash('success', 'The user (<strong>'.Input::get('name').'</strong>) was created successfuly');
		return Redirect::intended('users');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);

		return View::make('users.user')
					->with('user', $user );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);
		return View::make('users.user')
					->with('edit', true)
					->with('user', $user );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try {
			$user = User::findOrFail($id);

			$user->name   = Input::get('name', $user->name);
			$user->email  = Input::get('email', $user->email);
			$user->role   = Input::get('role', $user->role);
			$user->enable = Input::get('enable', false);
			$user->save();

			// Session::flash('info', '<pre>'.print_r($_POST, true).'</pre>');
			// Session::flash('error', 'You are not allowed to access this resource');
			Session::flash('success', 'The user (<strong>'.$user->name.'</strong>) was updated successfuly');
			return Redirect::intended('users');
		} catch (HTTPException $e) {
			App::abort(404);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function enable($id)
	{
		try {
			// $page = Paginator::getCurrentPage();
			$page = Input::get("page", 1);

			$user = User::findOrFail($id);
			$user->enable = 1 - Input::get('enable');
			$user->save();

			// Session::flash('info', 'Enable/Disable: (GET) <pre>'.print_r($_GET, true).'</pre>');
			// Session::flash('error', 'You are not allowed to access this resource');
			Session::flash('success', 'The user <strong>'.$user->name.'</strong> was updated successfuly');

			return Redirect::intended('users?page='.$page);
		} catch (HTTPException $e) {
			App::abort(404);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try {
			$page = Input::get("page", 1);

			$user = User::findOrFail($id);

			// Session::flash('info', 'Delete: (POST) <pre>'.print_r($_POST, true).'</pre>');
			// Session::flash('warning', 'You are not allowed to access this resource');
			Session::flash('success', 'The user <strong>('.$id.')'.$user->name.'</strong> was updated successfuly');
			User::destroy($id);
			return Redirect::intended('users?page='.$page);
		} catch (HTTPException $e) {
			App::abort(404);
		}
	}

}
