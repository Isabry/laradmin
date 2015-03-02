<?php
/**
 * @package   Laradmin
 * @author    Ismail SABRY <ismail@sabry.fr>
 * @copyright Copyright (c) Ismail SABRY
 */
namespace App\Http\Controllers;

use App\User;
use View;
use Input;
use Session;
use Redirect;

class UsersController extends Controller {

	/*-------------------------------------------------------------------------
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// if( !Auth::check() ) { 
		// 	return Redirect::intended('login');
		// }

		if( true ) {
			$users = User::paginate(10);
			return View::make('users.index')->with('users', $users);
		} else {
			Session::flash('error', 'You are not allowed to access Members list');
			return Redirect::intended('home');
		}	
	}

	/*-------------------------------------------------------------------------
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/*-------------------------------------------------------------------------
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/*-------------------------------------------------------------------------
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

	/*-------------------------------------------------------------------------
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

	/*-------------------------------------------------------------------------
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::findOrFail($id);

		$user->name = Input::get('name', $user->name);
		$user->email = Input::get('email', $user->email);
		$user->role = Input::get('role', $user->role);
		$user->enable = Input::get('enable', false);
		$user->save();

		Session::flash('info', '<pre>'.print_r($_POST, true).'</pre>');
		// Session::flash('error', 'You are not allowed to access this resource');
		// Session::flash('success', 'The user (<strong>'.$user->name.'</strong>) was updated successfuly');
		return Redirect::intended('users');
	}

	/*-------------------------------------------------------------------------
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function enable($id)
	{
		// $page = Paginator::getCurrentPage();
		$page = Input::get("page", 1);

		$user = User::findOrFail($id);
		$user->enable = 1 - Input::get('enable');
		$user->save();

		// Session::flash('info', 'Enable/Disable: (GET) <pre>'.print_r($_GET, true).'</pre>');
		// Session::flash('error', 'You are not allowed to access this resource');
		Session::flash('success', 'The user <strong>'.$user->name.'</strong> was updated successfuly');

		return Redirect::intended('users?page='.$page);
	}

	/*-------------------------------------------------------------------------
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::findOrFail($id);

		Session::flash('info', 'Delete: (POST) <pre>'.print_r($_POST, true).'</pre>');
		// Session::flash('warning', 'You are not allowed to access this resource');
		// Session::flash('success', 'The user <strong>('.$id.')'.$user->name.'</strong> was updated successfuly');
		return Redirect::intended('users');
	}

}
