# laravel-vtung 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codejutsu1/laravel-vtung.svg?style=flat-square)](https://packagist.org/packages/codejutsu1/laravel-vtung)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/codejutsu1/laravel-vtung/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/codejutsu1/laravel-vtung/actions?query=workflow%3Arun-tests+branch%3Amain)
[![License](https://img.shields.io/packagist/l/codejutsu1/laravel-vtung.svg?style=flat-square)](https://packagist.org/packages/codejutsu1/laravel-vtung)
[![Total Downloads](https://img.shields.io/packagist/dt/codejutsu1/laravel-vtung.svg?style=flat-square)](https://packagist.org/packages/codejutsu1/laravel-vtung)

> An Elegant Laravel Package for [vtu.ng](https://vtu.ng)

## Installation

[PHP](https://www.php.net/) 8.2+ and [Composer](https://getcomposer.org/) are required.

- Install the package via composer:

    ```bash
    composer require codejutsu1/laravel-vtung
    ```

- `Optional` you can publish the config file via this command:

    ```bash
    php artisan vtung:install
    ```

    A configuration file named `vtung.php` will be placed in the `config` folder of your laravel application:

    ```php
    <?php

    // config for Codejutsu1/LaravelVtuNg
    return [
        /**
         * VTU username
         * 
         */
        'username' => env('VTU_USERNAME') ?? null,
        /**
         * VTU Password
         * 
         */
        'password' => env('VTU_PASSWORD') ?? null,
    ];

    ```

## Usage

Open your `.env` file and add your username and password: 

```
VTU_USERNAME=
VTU_PASSWORD=
```
>[!IMPORTANT] 
> You must have a reseller account with [vtu.ng](https://vtu.ng/api/) to use our API.

### Services

- [Wallet Balance](#check-your-wallet-balance)
- [Airtime](#buy-airtime)
- [Data](#buy-data)
- [Customer Verification](#verify-customers-using-their-meter-number-and-iucsmartcard-number)
- [CableTv](#purchasesubscribe-cabletv)
- [Electricity](#pay-electricity-bills)
- [Format Number](#format-number)
- [Network Provider](#network-provider)

### Check your wallet balance
```php
<?php 

use Codejutsu1\LaravelVtuNg\Facades\Vtu;

try{
    $response = Vtu::getBalance();

    $balance = $response['data']['balance'];

    return $balance;
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}

```

### Buy Airtime

It requires 3 parameters as an array to make airtime purchase from [vtu.ng](https://vtu.ng/#airtime)

```php
<?php

$data = [
    'phone' =>  '09137822222', // Phone Number 
    'network_id' => 'mtn', // Network Provider
    'amount' => 2000 //int Amount to recharge
];

try{
    return Vtu::buyAirtime($data);

    /**
     * Alternatively
     * 
     * return vtu()->buyAirtime($data);
     */ 
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}
```

### Format Number 

You can also format Nigerian Number with +234 code to local number.

```php
<?php

//Format  +2349010344345 to 09010344345

try{
    return Vtu::formatNumber('+2349010344345');
    
    /**
     * Alternatively
     * 
     * return vtu()->formatNumber('+2349010344345');
     */    
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}
```

### Network Provider

This package gives you the power to get the network provider of any number in Nigeria.

```php
<?php

try{
    return Vtu::getNetworkProvider('+2349010344345');

    /**
     * Alternatively
     * 
     * return vtu()->getNetworkProvider('+2349010344345');
     */    
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}
```
>[!NOTE]
> You can always use the class `Vtu::buyAirtime()` or the helper `vtu()->buyAirtime()`

### Buy Data

It requires 3 parameters as an array to make data purchase from [vtu.ng](https://vtu.ng/#data)

```php
<?php

$data = [
    'phone' =>  '09137822222', // Phone Number 
    'network_id' => 'mtn', // Network Provider
    'variation_id' => 'mtn-75gb-15000' //variation id of the mobile data to purchase
];

try{
    return Vtu::buyData($data);  
    /**
     * Alternatively
     * 
     * return vtu()->buyData($data);
     */  
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}
```
>[!IMPORTANT]
> You can get the data `variation id` from the [vtu.ng](https://vtu.ng/api/#data)

### Verify Customers using their meter number and IUC/Smartcard Number

It requires 3 parameters as an array to verify a customer from [vtu.ng](https://vtu.ng/api/#verify-customers)

```php
<?php

$data = [
    'customer_id' =>  '62418234034', // Customer's smartcard number or meter number
    'service_id' => 'gotv', // Unique id for all cable Tv and electricity services.
    'variation_id' => 'prepaid' // Meter type of the electricity company, optional for cable Tvs.
];

try{
    return Vtu::verifyCustomer($data);  
    /**
     * Alternatively
     * 
     * return vtu()->verifyCustomer($data);
     */  
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}
```
>[!IMPORTANT]
> You can get the `service_id` from [vtu.ng](https://vtu.ng/api/#verify-customers).
> You can verify EEDC customers using the `service_id` as `enugu-electric` but you can't pay EEDC Electricity Bills with [vtu.ng](https://vtu.ng/api/#electricity).


### Purchase/Subscribe CableTv

It requires 4 parameters as an array to purchase or subscribe CableTv from [vtu.ng](https://vtu.ng/api/#tv)

```php
<?php

$data = [
    'phone' => '09137822222', //Phone number stored for reference
    'smartcard_number' =>  '62418234034', // Customer's smartcard/IUC number 
    'service_id' => 'gotv', // Unique id for all cable Tv.
    'variation_id' => 'gotv-max' // Variation ID for cable package.
];

try{
    return Vtu::subscribeTv($data); 
    /**
     * Alternatively
     * 
     * return vtu()->subscribeTv($data);
     */   
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}

```
>[!IMPORTANT]
> You can get the `service_id` and `variation_id` from [vtu.ng](https://vtu.ng/api/#tv).

### Pay Electricity Bills

To purchase, it requires 5 parameters as an array to pay electricity bills from [vtu.ng](https://vtu.ng/api/#electricity)

```php
<?php

$data = [
    'phone' => '09137822222', //Phone number stored for reference
    'meter_number' =>  '62418234034', // Customer's meter number
    'service_id' => 'ikeja-electric', // Unique id for electricity companies.
    'variation_id' => 'prepaid', // meter type, either prepaid or postpaid.
    'amount' => 8000, //amount of electricity you want to purchase.
];

try{
    return Vtu::buyElectricity($data);
    /**
     * Alternatively
     * 
     * return vtu()->buyElectricity($data);
     */  
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}
```

>[!IMPORTANT]
> As usual, you can get the `service_id` and `variation_id` from [vtu.ng](https://vtu.ng/api/#electricity).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Feel free to submit Issues (for bugs or suggestions) and Pull Requests.

## Security Vulnerabilities

If you discover a security vulnerability within this package, please send an email to Daniel Dunu at [danieldunu001@gmail.com](mailto:danieldunu001@gmail.com). All security vulnerabilities will be promptly addressed..

## Credits

- [Daniel Dunu](https://github.com/codejutsu1)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
