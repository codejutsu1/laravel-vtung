<?php

use Codejutsu1\LaravelVtuNg\Vtu;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('can be used to develop a package', function() {
    $vtu = new VTU();
    dd($vtu);
});
