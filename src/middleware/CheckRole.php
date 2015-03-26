<?php
/**
 * @package   Laradmin
 * @author    Ismail SABRY <ismail@sabry.fr>
 * @copyright Copyright (c) Ismail SABRY
 */
namespace Isabry\Laradmin\Middleware;

use Closure;
use Debugbar;
use Illuminate\Http\RedirectResponse;

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
		if( $this->checkUserRole($request) ) {
			return $next($request);
		}
		// return response([
		// 	'error' => [
		// 		'code' => 'INSUFFICIENT_ROLE',
		// 		'description' => 'You are not authorized to access this resource.'
		// 	]
		// ], 401);
		return new RedirectResponse(url('/'));
	}

	/**
	 * Check user role
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return true/false
	 */
	private function checkUserRole($request)
	{
		$role = $request->user()->role;

		Debugbar::info("[CheckRole] role : " . $role);

		$actions = $request->route()->getAction();
		Debugbar::info("[CheckRole] actions : ");
		Debugbar::info($actions);

		if( isset($actions['permissions']) ) {
			Debugbar::info($actions['permissions']);
			if(in_array($role, $actions['permissions'])) {
				return true;
			} else {
				return false;
			}
		}

		return true;
	}

}