# laravel-vtung 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codejutsu1/laravel-vtung.svg?style=flat-square)](https://packagist.org/packages/codejutsu1/laravel-vtung)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/codejutsu1/laravel-vtung/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/codejutsu1/laravel-vtung/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/codejutsu1/laravel-vtung/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/codejutsu1/laravel-vtung/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/codejutsu1/laravel-vtung.svg?style=flat-square)](https://packagist.org/packages/codejutsu1/laravel-vtung)

> An Elegant Laravel Package for [vtu.ng](https://vtu.ng)

## Installation

- Install the package via composer:

    ```bash
    composer require codejutsu1/laravel-vtung
    ```

- Register the service provider and publish the config file via this command:

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


### Check your wallet balance
```php
<?php 

try{
    $response = Vtu::getBalance();

    $balance = $response['data']['balance'];

    return $balance;
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}

```

### Buy Airtime

It requires 3 parameters to make airtime purchase from [vtu.ng](https://vtu.ng/#airtime)

```php
<?php

$data = [
    'phone' =>  '09137822222', // Phone Number 
    'network_id' => 'mtn', // Network Provider
    'amount' => 2000 //int Amount to recharge
];

try{
    return Vtu::buyAirtime($data);
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}
```

### Format Number 

You can also format numbers with country code to normal number.
```php
<?php

//Format  +2349010344345 to 09010344345

try{
    return Vtu::formatNumber('+2349010344345');
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}
```

### Network Provider

This package gives you the power to get the network provider of any number in Nigeria.

```php
<?php

try{
    $network = Vtu::getNetworkProvider('+2349010344345');

    // You can use the helper as an alternative
    $networkProvider = vtu()->getNetworkProvider('+2349010344345');

    return $networkProvider;    
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}
```
>[!NOTE]
> You can always use the class `Vtu::buyAirtime()` or the helper `vtu()->buyAirtime()`

### Buy Data

It requires 3 parameters to make data purchase from [vtu.ng](https://vtu.ng/#data)

```php
<?php

$data = [
    'phone' =>  '09137822222', // Phone Number 
    'network_id' => 'mtn', // Network Provider
    'variation_id' => 'mtn-75gb-15000' //variation id of the mobile data to purchase
];

try{
    return Vtu::buyData($data);  
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}
```
>[!IMPORTANT]
> You can get the data variation id from the [vtu.ng](https://vtu.ng/api/#data)

### Verify Customers with their meter number and IUC/Smartcard Number
It requires 3 parameters to verify a customer from [vtu.ng](https://vtu.ng/api/#verify-customers)

```php
<?php

$data = [
    'customer_id' =>  '62418234034', // Customer's smartcard number or meter number
    'service_id' => 'gotv', // Unique id for all cable Tv and electricity services.
    'variation_id' => 'prepaid' // Meter type of the electricity company, optional for cable Tvs.
];

try{
    return Vtu::verifyCustomer($data);  
}catch(\Exception $e){
    return redirect()->back()->withMessage($e->getMessage());
}
```
>[!IMPORTANT]
> You can get the customer_id, service_id and variation_id from the [vtu.ng](https://vtu.ng/api/#verify-customers)


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Daniel Dunu](https://github.com/codejutsu1)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
