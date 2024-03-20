<?php

namespace Codejutsu1\LaravelVtuNg\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Codejutsu1\LaravelVtuNg
 */
class Vtu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Codejutsu1\LaravelVtuNg\Vtu::class;
    }
}
