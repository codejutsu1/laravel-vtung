<?php

it('throws an exception when getting wallet balance', function () {
    vtu()->getBalance();
})->throws(Exception::class);

