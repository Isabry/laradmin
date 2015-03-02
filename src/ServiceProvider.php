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

	/*-------------------------------------------------------------------------
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		// echo("=> Package Path: ". __DIR__ ."\n");
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
		$configPath = __DIR__ . '/../config/laradmin.php';
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
