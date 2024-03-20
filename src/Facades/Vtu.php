<?php

namespace Codejutsu1\LaravelVtuNg\Vtu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Codejutsu1\LaravelVtuNg\Vtu\Vtu
 */
class Vtu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Codejutsu1\LaravelVtuNg\Vtu\Vtu::class;
    }
}
