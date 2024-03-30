<?php

it("throws an exception when verifying a customer from VTU.ng", function() {
    $para = [
        "customer_id" => "62418234034",
        "service_id" => "ikeja-electric",
        "variation_id" => "prepaid"
    ];

    vtu()->verifyCustomer($para);

})->throws(Exception::class);

it("throws an exception when subscribing for a cableTv", function() {
    $para = [
        "phone" => "07045461790",
        "service_id" => "gotv", 
        "smartcard_number" => "7032400086",
        "variation_id" => "gotv-max"
    ];

    vtu()->subscribeTv($para);

})->throws(Exception::class);