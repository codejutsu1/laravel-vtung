<?php

namespace Codejutsu1\LaravelVtuNg\Traits;

use Codejutsu1\LaravelVtuNg\Exceptions\VtuErrorException;

trait VtuResponses {
    public function responses($response)
    {
        if($response['code'] != 'success') return $this->error($response);

        return $response;
    }

    private function error($response)
    {
        if(!isset($response)) throw new VtuErrorException("We can't communicate with VTU server.")
        
        throw new VtuErrorException($response['message']);
    }
}

