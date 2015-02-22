<?php
/**
 * Install the Laradmin assets to the App directories
 * @author Isamil SABRY <isabry@gmail.com>
 */
namespace Isabry\Laradmin\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
	protected $name = 'laradmin:install';
	protected $description = 'Install the Laradmin assets';

	/*-------------------------------------------------------------------------
	* Execute the console command.
	*
	* @return void
	*/
	public function fire()
	{
		$this->info('Copy public/assets');
		$this->info('Migrate');
		$this->info('Seed');
	}
}