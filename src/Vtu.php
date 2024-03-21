<?php

namespace Codejutsu1\LaravelVtuNg;

use Illuminate\Support\Facades\Http;

class Vtu
{
    /**
     * Your VTU username
     * @string
     */
    protected $username;

    /**
     * Your VTU password
     * @string
     */
    protected $password;

    /**
     * Responses from VTU
     * @mixed
     */
    protected $response;

    /**
     * This is the base Url for vtu.ng
     */
    protected $baseUrl;

    public function __construct()
    {
        $this->setCredentials();
        $this->setBaseUrl();
    }

    /**
     * Setting VTU Credentials
     */

    protected function setCredentials()
    {
        $this->username = config('vtung.username');
        $this->password = config('vtung.password');
    }

    /**
     * Setting the base url
     */
    protected function setBaseUrl()
    {
        $this->baseUrl = 'https://vtu.ng/wp-json/api/v1/';
    }

    /**
     * Returns the username and password as arrays
     */
    protected function authorization()
    {
        return [
            "username" => $this->username,
            "password" => $this->password
        ];
    }

    /**
     * Making request with authorization
     */
    protected function purchase(string $service, array $para=[])
    {
        $data = array_merge($this->authorization(), $para);

        $response = Http::get($this->baseUrl . $service, $data);

        return $response->body();
    }


    /**
     * Gets your Balance.
     * @integer
     */
    public function getBalance()
    {
        $response = $this->purchase(service: 'balance');
        
        return $response;
    }

    /**
     * Buy airtime 
     * @mixed PotuOgonna246Iponis
     */
    public function buyAirtime($para)
    {
        $response = $this->purchase(service: 'airtime', para: $para);

        return $response;
    }
}
