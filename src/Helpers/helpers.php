<?php

if (! function_exists("vtu"))
{
    function vtu() {

        return app()->make(\Codejutsu1\LaravelVtuNg\Vtu::class);
    }
}