<?php 

it("throws an exception when buying electricity", function() {
    $para = [
        "phone" => "07045461790",
        "meter_number" => "62418234034",
        "service_id" => "ikeja-electric", 
        "variation_id" => "prepaid",
        "amount" => 3000
    ];

    vtu()->buyElectricity($para);

})->throws(Exception::class);