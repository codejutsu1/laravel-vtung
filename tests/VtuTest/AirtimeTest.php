<?php

use Codejutsu1\LaravelVtuNg\Facades\Vtu;

it('can buy airtime from VTU', function () {
    $data = [
        'hello' => 'Hello',
        'phone' => '07011290234',
        'network_id' => 'mtn',
    ];

    $response = vtu()->buyAirtime($data);
    
    dd($response);
});

