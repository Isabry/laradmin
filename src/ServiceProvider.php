<?php
/**
 * @package   Laradmin
 * @author    Ismail SABRY <ismail@sabry.fr>
 * @copyright Copyright (c) Ismail SABRY
 */
namespace Isabry\Laradmin;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 * This method is called after all other service providers have been registered, 
	 * @return void
	 */
	public function boot()
	{

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerAssets();
		$this->registerBindings();
	}

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function registerAssets()
	{
		// $app = $this->app;

		// Publish a config file
		$this->publishes([
    		__DIR__.'/../config/laradmin.php' => config_path('laradmin.php')
		], 'config');

		// Publish assets
		$this->publishes([
		    __DIR__.'/../assets/' => base_path('/public/assets')
		], 'migrations');

		// Publish migrations
		$this->publishes([
		    __DIR__.'/database/migrations/' => base_path('/database/migrations')
		], 'migrations');


		// Publish seeds
		$this->publishes([
		    __DIR__.'/database/seeds/' => base_path('/database/seeds')
		], 'seeds');


		include __DIR__.'/routes.php';

		$this->loadViewsFrom(__DIR__.'/views', 'laradmin');
	}

	/**
	 * Register the assets to be published
	 * @return void
	 */
	public function registerBindings()
	{
		$this->app['laradmin'] = $this->app->share(function($app) {
			return new LaradminMenu();
		});
		
		$this->app->bind('command.laradmin.clear', 'Isabry\Laradmin\Console\ClearCommand');

		$this->commands(array('command.laradmin.clear'));
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('laradmin', 'command.laradmin.clear');
	}
}
