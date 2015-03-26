<?php
/**
 * Clear the Laradmin assets to the App directories
 * @author Isamil SABRY <isabry@gmail.com>
 */
namespace Isabry\Laradmin\Console;

use Illuminate\Console\Command;

class ClearCommand extends Command
{
	protected $name = 'laradmin:clear';
	protected $description = 'Clean the Laradmin Assets';

	/*-------------------------------------------------------------------------
	* Execute the console command.
	*
	* @return void
	*/
	public function fire()
	{
		$this->info('laradmin:clear => Todo');
	}
}