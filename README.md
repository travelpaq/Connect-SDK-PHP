# TravelPAQ Connect Api

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Api para la búsqueda y reserva de paquetes turísticos de Tour Operadores

## Install

Via Composer

``` bash
$ composer require travel-paq/packages-api
```

## Usage

``` php

require "vendor/autoload.php";

use TravelPAQ\PackagesAPI\PackagesAPI;

$params = [
	'order_type' => "ASC",
	'order_field' => "PRICE",
	'currency' => "USD",
	'origin_place' => "EZE",
	'destination_place' => "IGR",
	'month_departure' => 9,
	'year_departure' => 2016,
	'Room' => [
		[
			'adult' => 2,
			'Children' => []
		]
	]
];

$tp = new PackagesAPI(['api_key' => 'YOUR_API_KEY','item_per_page' => 10]);
$list = json_decode($tp->getPackageList($params),true);
var_dump($list);
$package = json_decode($tp->getPackage($list['result'][0]['id']));
var_dump($package);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/travel-paq/packages-api.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/:vendor/:package_name/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/:vendor/:package_name.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/:vendor/:package_name.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/travel-paq/packages-api.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/travel-paq/packages-api
[link-travis]: https://travis-ci.org/:vendor/:package_name
[link-scrutinizer]: https://scrutinizer-ci.com/g/:vendor/:package_name/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/:vendor/:package_name
[link-downloads]: https://packagist.org/packages/travel-paq/packages-api
[link-author]: https://github.com/travelpaq
