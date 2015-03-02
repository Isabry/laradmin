<?php
/**
 * @package   Laradmin
 * @author    Ismail SABRY <ismail@sabry.fr>
 * @copyright Copyright (c) Ismail SABRY
 */
namespace App\Http\Middleware;

use Closure;

class CheckRole{

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// Check if a role is required for the route, and
		// if so, ensure that the user has that role.
		if( checkUserRole($request) ) {
			return $next($request);
		}
		return response([
			'error' => [
				'code' => 'INSUFFICIENT_ROLE',
				'description' => 'You are not authorized to access this resource.'
			]
		], 401);
	}

	/**
	 *
	 *
	 */
	private function checkUserRole($request)
	{
		// $role = $request->user()->role;

		// $actions = $request->route()->getAction();
		// return isset($actions['roles']) ? $actions['roles'] : null;

		return true;
	}

}