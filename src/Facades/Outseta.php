<?php

namespace RefBytes\Outseta\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RefBytes\Outseta\Outseta
 */
class Outseta extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \RefBytes\Outseta\Outseta::class;
    }
}
