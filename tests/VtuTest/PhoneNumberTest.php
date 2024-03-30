<?php

it("can format a phone number", function() {
    $phoneNumber = "+23409177333999";

    $response = vtu()->formatNumber($phoneNumber);

    expect($response)
        ->toBeString()
        ->toBe('09177333999');
});

it("thows an exception for a wrong phone number format", function() {
    $phoneNumber = "+23455";

    vtu()->formatNumber($phoneNumber);

})->throws("Wrong Phone Number Format");

it("can get the network provider of a number", function() {
    $phoneNumber = "+2347080110000";

    $response = vtu()->getNetworkProvider($phoneNumber);

    expect($response)
        ->toBeString()
        ->toBe("airtel");
});

it("doesnt return the wrong network provider of a number", function() {
    $phoneNumber = "+23480638110000";

    $response = vtu()->getNetworkProvider($phoneNumber);

    expect($response)
        ->not->toMatchArray([
            'airtel',
            'glo',
            'etisalat'
        ]);
});