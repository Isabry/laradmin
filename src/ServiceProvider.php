<?php 
/*
**
*/
namespace Isabry\Laradmin;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
	/*-------------------------------------------------------------------------
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	protected $packagePath;

	/*-------------------------------------------------------------------------
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Find path to the package
		$packageFilename = with(new \ReflectionClass('\Isabry\Laradmin\ServiceProvider'))->getFileName();
		$this->packagePath = dirname($packageFilename);

		// echo("=> Package Path: ".$this->packagePath."\n");

		// Load the package
		// $this->package('isabry/laradmin');

		// Load views
		$this->loadViewsFrom($this->packagePath.'/views', 'laradmin');

		// Establish Translator Namespace
		$this->loadTranslationsFrom($this->packagePath.'/lang', 'laradmin');

		// Load routes
		include $this->packagePath.'/../routes.php';
		include $this->packagePath.'/../filters.php';

	}

	/*-------------------------------------------------------------------------
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerCommands();		
	}

	/*-------------------------------------------------------------------------
	 */
	public function registerCommands()
	{
		// publish config To [/config/laradmin.php]
		// php artisan vendor:publish
		$configPath = $this->packagePath . '/../config/laradmin.php';
		$this->publishes([$configPath => config_path('laradmin.php')], 'config');

		// install command
		$this->app->bind('command.laradmin.install', 'Isabry\Laradmin\Console\InstallCommand');
		$this->app->bind('command.laradmin.clear', 'Isabry\Laradmin\Console\ClearCommand');
		$this->commands(array('command.laradmin.install', 'command.laradmin.clear'));
	}

	/*-------------------------------------------------------------------------
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('laradmin', 'command.laradmin.install', 'command.laradmin.clear');
	}
}
