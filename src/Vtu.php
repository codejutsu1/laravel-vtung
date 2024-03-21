<?php

namespace Codejutsu1\LaravelVtuNg;

use Illuminate\Support\Facades\Http;
use Codejutsu1\LaravelVtuNg\Traits\VtuResponses;
use Codejutsu1\LaravelVtuNg\Traits\NetworkProviders;
use Codejutsu1\LaravelVtuNg\Exceptions\VtuErrorException;


class Vtu
{
    use VtuResponses, NetworkProviders;
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

    public function buyElectricity($para): VtuResponses
    {
        return $this->purchase(service: 'electricity', para: $para);
    }

    public function formatNumber(string $number): string
    {
        $number = (string) $number;

        if(strlen($number) > 11){
            $code = substr($number, 0 ,4);

            if($code != '+234') 
                throw new VtuErrorException('This is not a Nigeria Number');

            $number = substr($number, 4);
        }

        if(strlen($number) == 10) {
            $number = '0' . $number;
        }

        if(strlen($number) > 15 || strlen($number) < 11 || strlen($number) == 11 && $number[0] != '0') 
            throw new VtuErrorException('Wrong Phone Number Format');

        return $number;
    }

    public function getNetworkProvider(string $number): string
    {
        try{
            $number = $this->formatNumber($number);
        }catch(VtuErrorException $e)
        {
            return $e->getMessage();
        } 

        $digit = substr($number, 0, 4);

        $digit_2 = substr($number, 0, 5);

        switch(true)
        {
            case in_array($digit, $this->mtn()) || in_array($digit_2, $this->mtn()):
                return "mtn";
                break;
            case in_array($digit, $this->airtel()):
                return "airtel";
                break;
            case in_array($digit, $this->glo()):
                return "glo";
                break;
            case in_array($digit, $this->mobile_9()):
                return "etisalat";
                break;
            default:
                return "Could not resolve. Please contact us to resolve the issue.";
        }
    }
}
