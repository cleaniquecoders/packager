<?php

namespace DummyNamespace;

/**
 * This file is part of PackageName
 *
 * @license MIT
 * @package PackageName
 */

use Illuminate\Support\Facades\Facade;

class DummyClassNameFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'FacadeName';
    }
}
