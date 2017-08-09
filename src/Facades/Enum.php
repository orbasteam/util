<?php

namespace Orbas\Util\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Orbas\Util\Enum
 */
class Enum extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'enum';
    }
}
