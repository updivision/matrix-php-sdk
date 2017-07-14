<?php

namespace Updivision\Matrix\Facades;

use Illuminate\Support\Facades\Facade;

class Matrix extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'matrix';
    }
}
