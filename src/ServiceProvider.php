<?php 
/*
**
*/
namespace Isabry\Laradmin;

use Illuminate\Support\ServiceProvider;

class ServiceProvider extends ServiceProvider
{
	/*-------------------------------------------------------------------------
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/*-------------------------------------------------------------------------
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Find path to the package
		$packageFilename = with(new \ReflectionClass('\Isabry\Laradmin\ServiceProvider'))->getFileName();
		$packagePath = dirname($packageFilename);

		echo("=> Package Path: ".$packagePath."\n");

		// Load the package
		// $this->package('isabry/laradmin');

		// Load views
		$this->loadViewsFrom($packagePath.'/views', 'laradmin');

		// Load routes
		include $packagePath.'/../routes.php';
		include $packagePath.'/../filters.php';
	}

	/*-------------------------------------------------------------------------
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

	}

	/*-------------------------------------------------------------------------
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}
}
