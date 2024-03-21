<?php

namespace Codejutsu1\LaravelVtuNg;

use Illuminate\Support\Facades\Http;
use Codejutsu1\LaravelVtuNg\Traits\VtuResponses;


class Vtu
{
    use VtuResponses;
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

        return $this->responses($response->json());
    }


    /**
     * Gets your Balance.
     * @integer
     */
    public function getBalance()
    {
        return $this->purchase(service: 'balance');
    }

    /**
     * Buy airtime 
     * @mixed PotuOgonna*ya*246Iponis
     */
    public function buyAirtime($para)
    {
        return $this->purchase(service: 'airtime', para: $para);
    }

    /**
     * Buy Data
     */
    public function buyData($para)
    {
        return $this->purchase(service: 'data', para: $para);
    }

    public function verifyCustomer($para)
    {
        return $this->purchase(service: 'verify-customer', para: $para);
    }

    public function subscribe($para)
    {
        return $this->purchase(service: 'tv', para: $para);
    }

    public function buyElectricity($para)
    {
        return $this->purchase(service: 'electricity', para: $para);
    }
}
