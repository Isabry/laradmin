<?php
/**
 * Install the Laradmin assets to the App directories
 * @author Isamil SABRY <isabry@gmail.com>
 */
namespace Isabry\Laradmin\Console;

use Illuminate\Console\Command;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
	protected $name = 'laradmin:install';
	protected $description = 'Install the Laradmin assets';

	protected $files;

	/*-------------------------------------------------------------------------
	 * Create a new reminder table command instance.
	 *
	 * @param  \Illuminate\Filesystem\Filesystem $files
	 * @return \Isabry\AdminLaravel\Console\CViwsCommand
	 */
	public function __construct(Container $app, Filesystem $files)
	{
		parent::__construct();
		$this->app = $app;
		$this->files = $files;
	}

	/*-------------------------------------------------------------------------
	* Execute the console command.
	*
	* @return void
	*/
	public function fire()
	{
		if ( $this->confirm('Do you wish to continue? [yes|no] (yes)', true) ) {
			$this->line('--------------------------------------------------');
			$this->install_assets();
			$this->line('--------------------------------------------------');
			$this->run_migrate();
			$this->line('--------------------------------------------------');
			$this->run_seed();
		} else {
			$this->error('Initialize was stopped by the user.');
		}
	}

	/*-------------------------------------------------------------------------
	*/
	public function install_assets()
	{
		$this->line('Install  public/assets');

		$src = __DIR__.'/../../public/admin';
		$des = $this->laravel['path'].'/../public/admin';

		// $this->info('assets source : ' . $src);
		// $this->info('assets destination : ' . $des);

		if ( !$this->files->exists($des) ) {
			$this->files->copyDirectory($src, $des);
			$this->info('Assets created successfully!');
			return true;
		} else {
			$this->error('Assets already exists!');
			$this->comment('Please remove the existing assets and try again!');
			return false;
		}
	}

	/*-------------------------------------------------------------------------
	*/
	public function run_migrate()
	{
		$this->line('Migrate');

		// $migrator = $this->app->make('migrator');
        // $migrator->run(__DIR__.'/../database/migrations');
		// $this->info('Migration updated successfully!');

		$this->call('migrate');
	}

	/*-------------------------------------------------------------------------
	*/
	public function run_seed()
	{
		$this->line('Seed');
		$this->call('db:seed', ['--class'=>'DatabaseSeeder']); 
	}
}