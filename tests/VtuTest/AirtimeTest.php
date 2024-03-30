<?php

it('throws an exception when buying airtime', function () {
    $data = [
        'phone' => '00112233445',
        'network_id' => 'mtn',
        'amount' => 40000   
    ];

    vtu()->buyAirtime($data);
})->throws(Exception::class);

