<?php
/**
 * Laradmin Menu Facade
 *
 * @package   isabry/laradmin
 * @author    Isamil SABRY <ismail@sabry.fr>
 * @copyright Copyright (c) Isamil SABRY
 */

namespace Isabry\Laradmin\Facades;

use Illuminate\Support\Facades\Facade;

class LaradminFacade extends Facade
{
    /**
     * Get the registered name of the component
     * @return string
     * @codeCoverageIgnore
     */
    protected static function getFacadeAccessor()
    {
        return 'laradmin';
    }
}