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
			$this->install_config(); 
			$this->line('--------------------------------------------------');
			$this->install_assets();
			$this->line('--------------------------------------------------');
			$this->install_migration();
			$this->line('--------------------------------------------------');
			$this->install_seeds();
			$this->line('--------------------------------------------------');
			$this->install_controllers();
			$this->line('--------------------------------------------------');
			$this->install_views();
		} else {
			$this->error('Initialize was stopped by the user.');
		}
	}

	/*-------------------------------------------------------------------------
	*/
	public function install_config()
	{
		$this->line('Config');

		$src = __DIR__.'/../../config/laradmin.php';
		$des = base_path().'/config/laradmin.php';

		// $this->info('config source : ' . $src);
		// $this->info('config destination : ' . $des);

		$this->update_file($src, $des);

		$this->line('Publishing Complete!');
	}

	/*-------------------------------------------------------------------------
	*/
	public function install_assets()
	{
		$this->line('Install Assets');

		$src = __DIR__.'/../../public/admin';
		$des = base_path().'/public/admin';

		// $this->info('assets source : ' . $src);
		// $this->info('assets destination : ' . $des);

		$this->update_directory($src, $des);

		$this->line('Publishing Complete!');
	}

	/*-------------------------------------------------------------------------
	*/
	public function install_migration()
	{
		$this->line('Install Migrations');

		// install database
		$src = __DIR__.'/../database';
		$des = base_path().'/storage';

		$this->update_file($src.'/database.sqlite', $des.'/database.sqlite');

		// insttal migration files
		$src = __DIR__.'/../database/migrations';
		$des = base_path().'/database/migrations';

		$this->update_file(
			$src.'/2014_09_12_000100_create_users_table.php', 
			$des.'/2014_09_12_000100_create_users_table.php');
		$this->update_file(
			$src.'/2014_09_12_000200_create_password_resets_table.php', 
			$des.'/2014_09_12_000200_create_password_resets_table.php');

		$this->line('Publishing Complete!');
	}

	/*-------------------------------------------------------------------------
	*/
	public function install_seeds()
	{
		$this->line('Install Seeds');

		// insttal migration files
		$src = __DIR__.'/../database/seeds';
		$des = base_path().'/database/seeds';

		$this->update_file($src.'/DatabaseSeeder.php', $des.'/DatabaseSeeder.php');
		$this->update_file($src.'/UsersTableSeeder.php', $des.'/UsersTableSeeder.php');

		$this->line('Publishing Complete!');
	}

	/*-------------------------------------------------------------------------
	*/
	public function install_controllers()
	{
		$this->line('Install Controllers');

		// install routes 
		$src = __DIR__.'/../..';
		$des = app_path().'/Http';

		$this->update_file($src.'/routes.php', $des.'/routes.php');

		// install controllers
		$src = __DIR__.'/../controllers';
		$des = app_path().'/Http/Controllers';

		$this->update_directory($src, $des);

		$this->line('Publishing Complete!');
	}

	/*-------------------------------------------------------------------------
	*/
	public function install_views()
	{
		$this->line('Install Views');

		$src = __DIR__.'/../views';
		$des = base_path().'/resources/views';

		$this->update_directory($src.'/auth', $des.'/auth', false);
		$this->update_directory($src.'/errors', $des.'/errors');
		$this->update_directory($src.'/layouts', $des.'/layouts', false);
		$this->update_directory($src.'/home', $des.'/home', false);
		$this->update_directory($src.'/welcome', $des.'/welcome', false);
		$this->update_directory($src.'/users', $des.'/users', false);

		$this->line('Publishing Complete!');
	}

	/*-------------------------------------------------------------------------
	*/
	private function update_directory($src, $des, $force=false)
	{
		$offset = strlen(base_path());

		if ( !$this->files->exists($des) ) {
			$this->info('Installing : ' . substr($des, $offset) );
			$this->files->copyDirectory($src, $des);
		} elseif ($force) {
			$this->info('Force update : ' . substr($des, $offset) );
			$this->files->copyDirectory($src, $des);
		} else {
			$this->info("Up to date : " . substr($des, $offset) );
			$src_files = $this->scan_dir($src);	
			// print_r($src_files);
			$des_files = $this->scan_dir($des);	
			// print_r($des_files);

			foreach ($src_files as $key => $src_file) {
				if(is_file ($src_file)) {
					$subpath = substr(dirname($src_file), strlen($src));
					$des_file = $des . $subpath . "/" . basename($src_file);
					// $this->info("src : " . $src_file);
					// $this->info("des : " . $des_file);

					$this->update_file($src_files[$key], $des_file);
				}
			}
			foreach ($des_files as $key => $des_file) {
				if(is_file ($des_file)) {
					$subpath = substr(dirname($des_file), strlen($des));
					$src_file = $src . $subpath . "/" . basename($des_file);
					// $this->info("src : " . $src_file);
					// $this->info("des : " . $des_file);
					if ( !file_exists($src_file) ) {
						$this->error("missing : " . $src_file);
						// $this->info("src : " . $src_file);
						// $this->info("des : " . $des_file);					
					}
				}
			}
		}
	}

	/*-------------------------------------------------------------------------
	*/
	private function scan_dir($dir)
	{
		$result = [];
		exec("find " . $dir, $result);
		return $result;
	}

	/*-------------------------------------------------------------------------
	*/
	private function update_file($src, $des)
	{
		// $text = "src a été modifié le : " . date ("F d Y H:i:s.", filemtime($src)) . "(" . filemtime($src) . ")";
		// $this->line($text);
		// $text = "des a été modifié le : " . date ("F d Y H:i:s.", filemtime($des)) . "(" . filemtime($des) . ")";
		// $this->line($text);
 
		$offset = strlen(base_path());
		if ( !$this->files->exists($des) ) {
			$this->info("Installing : " . substr($des, $offset) );
			// $this->info("From " . substr($src, $offset) );
			$this->files->copy($src, $des);			
		} elseif( filemtime($src) > filemtime($des) ) {
			$this->info("Updating : " . substr($des, $offset) );
			// $this->info("From " . substr($src, $offset) );
			$this->files->copy($src, $des);
		} elseif( $this->compare_files($src, $des) ) {
			$this->error("Moified : " . substr($des, $offset) );
		} else {
			$this->info("Up to date : " . substr($des, $offset) );			
		}
	}

	/*-------------------------------------------------------------------------
	*/
	private function compare_files($src, $des)
	{
		$ret = false;

		if( sha1_file($src) != sha1_file($des) ) {
			return true;
		}

		$src_data = file_get_contents($src);
		$des_data = file_get_contents($des);
		$src_lines = explode("\n", $src_data);
		$des_lines = explode("\n", $des_data);

		if( count($src_lines) != count($des_lines) ) {
			$this->error("Moified : src " . count($src_lines) . " lines / des " . count($des_lines) . " lines");
			$ret = true;
		} else {
			foreach($src_lines as $key => $line) {
				if( $src_lines[$key] != $des_lines[$key] ) {
					$this->error("Moified : line " . $key . "(" . $src . ")");
					$ret = true;
				}
			}
		}

		return $ret;
	}
}