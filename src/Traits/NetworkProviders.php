<?php

namespace Codejutsu1\LaravelVtuNg\Traits;

trait NetworkProviders {
    public function mtn(): array 
    {
        return [
            '0803',

            '0806',
                
            '0810',
                
            '0813',
                
            '0814',
                
            '0816',
                
            '0903',
                
            '0906',
                
            '0913',
                
            '0916',
                
            '07025',
                
            '07026',
                
            '0703',
                    
            '0706', 
            
            '0704'
        ];
    }

    public function airtel(): array 
    {
        return [
            '0701',

            '0708',

            '0802',

            '0808',

            '0812',

            '0901',

            '0902',

            '0904',

            '0907',

            '0912'
        ];
    }

    public function glo(): array
    {
        return [
            '0805', '0807', '0811', '0815', '0705', '0905', '0915'
        ];
    }

    public function mobile_9()
    {
        return [
            '0809', '0817', '0818', '0908', '0909'
        ];
    }
}