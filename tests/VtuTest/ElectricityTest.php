<?php 

use Codejutsu1\LaravelVtuNg\Facades\Vtu;

it("buy electricity", function() {
    $para = [
        "phone" => "07045461790",
        "meter_number" => "62418234034",
        "service_id" => "ikeja-electric", 
        "variation_id" => "prepaid",
        "amount" => 3000
    ];

    try{
        return Vtu::buyElectricity($para);
    }catch(\Exception $e) {
        dd($e);
    }

});