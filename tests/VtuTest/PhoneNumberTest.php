<?php

it("can format a phone number", function() {
    $phoneNumber = "+23409137836455";
    try{
        dd(vtu()->formatNumber($phoneNumber));
    }catch(\Exception $e){
        dd($e->getMessage());
    }
});

it("can get the network provider of a number", function() {
    $phoneNumber = "+2347080119082";

    try{
        dd(vtu()->getNetworkProvider($phoneNumber));
    }catch(\Exception $e){
        dd($e->getMessage());
    }
});