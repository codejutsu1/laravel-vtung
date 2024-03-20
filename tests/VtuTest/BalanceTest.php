<?php

use Codejutsu1\LaravelVtuNg\Facades\Vtu;

it('can get the balance from VTU', function () {
    $response = vtu()->getBalance();
    
    dd($response);
});

