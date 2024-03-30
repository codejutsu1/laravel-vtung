<?php

namespace Codejutsu1\LaravelVtuNg;

use Illuminate\Support\Facades\Http;
use Codejutsu1\LaravelVtuNg\Traits\VtuResponses;
use Codejutsu1\LaravelVtuNg\Traits\NetworkProviders;
use Codejutsu1\LaravelVtuNg\Exceptions\VtuErrorException;


class Vtu
{
    use VtuResponses, NetworkProviders;

    protected ?string  $username;
    protected ?string $password;
    protected string $baseUrl;


    public function __construct()
    {
        $this->setCredentials();
        $this->setBaseUrl();
    }

    protected function setCredentials()
    {
        $this->username = config('vtung.username');
        $this->password = config('vtung.password');
    }

    protected function setBaseUrl()
    {
        $this->baseUrl = 'https://vtu.ng/wp-json/api/v1/';
    }

    protected function authorization(): array
    {
        return [
            "username" => $this->username,
            "password" => $this->password
        ];
    }

    protected function purchase(string $service, array $para=[]): array
    {
        $data = array_merge($this->authorization(), $para);

        $response = Http::get($this->baseUrl . $service, $data);

        return $this->responses($response->json());
    }

    public function getBalance(): array
    {
        return $this->purchase(service: 'balance');
    }

    public function buyAirtime($para): array
    {
        return $this->purchase(service: 'airtime', para: $para);
    }

    public function buyData($para): array
    {
        return $this->purchase(service: 'data', para: $para);
    }

    public function verifyCustomer($para): array
    {
        return $this->purchase(service: 'verify-customer', para: $para);
    }

    public function subscribeTv($para): array
    {
        return $this->purchase(service: 'tv', para: $para);
    }

    public function buyElectricity($para): array
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
                return "Could not resolve. Please contact us to resolve this number.";
        }
    }
}
