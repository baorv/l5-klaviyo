# Laravel Klaviyo API

Wrapper Klaviyo API works with Laravel 5.5

## Requirements

* PHP 7.0.0 (or higher)
* Laravel framework >= v5.5
* Package [ixudra/curl](https://packagist.org/packages/ixudra/curl)

## Installation

```php
"require": {
    "baorv/klaviyo": "dev-master"
}
```

## Configurations

Add ServiceProvider to config/app.php
```php
'providers' => [
    \Baorv\Klaviyo\KlaviyoServiceProvider::class,
]
```

After that, run below command to publish vendor config

```php
php artisan vendor:publish
```

Add two enviroment configurations:
API Key and Public Key you can get it from : [https://www.klaviyo.com/account#api-keys-tab](https://www.klaviyo.com/account#api-keys-tab)

```php
KLAVIYO_API_KEY={your-api-key}
KLAVIYO_PUBLIC_KEY={your-public-key}
```

## Usage

```php
$campaignApi = app(Secomapp\Klaviyo\Resources\Campaign::class);
$campaignApi->all();
```

With catching exception

```php
try{
    $campaign = app(\Baorv\Klaviyo\Resources\Campaign::class);
    $campaign->all();
}catch (\Baorv\Klaviyo\Exceptions\KlaviyoApiException $exception) {
    $exception->getMessage();
}

```

## License
This project is licensed under the [MIT License](LICENSE).

## Contribution

## Todo

* Add unit test