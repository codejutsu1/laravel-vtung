<?php

it("returns an exception when you buy data", function() {
    $data = [ 
        'phone' => '07045461790',
        'network_id' => 'mtn',
        'variation_id' => 'mtn-75gb-15000'
    ];
    
    vtu()->buyData($data);

})->throws(Exception::class);