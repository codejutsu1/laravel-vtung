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
    protected $baseUrl

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
     * Making request with authorization
     */
    protected function purchase(string $service, array $para=null)
    {
        $response = Http::get($this->baseUrl . $service, $para);

        return $response->body();
    }


    /**
     * Gets your Balance.
     * @integer
     */
    public static function getBalance()
    {

    }
}
