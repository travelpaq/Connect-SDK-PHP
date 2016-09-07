<?php

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

$tp = new PackagesAPI(['api_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpIjoiNTAifQ.35LFiBOikbD0zQxSlXKe6_t2jltNxQc3FZm5cMGKssA','item_per_page' => 10]);
$list = json_decode($tp->getPackageList($params),true);
var_dump($list);
$package = json_decode($tp->getPackage($list['result'][0]['id']));
var_dump($package);
