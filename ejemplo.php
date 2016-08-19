<?php

require "vendor/autoload.php";

use TravelPAQ\PackagesAPI\PackagesAPI;

$a = '{"order_type":"ASC","order_field":"PRICE","currency":"USD","origin_place":"EZE","destination_place":"IGR","month_departure":9,"year_departure":2016,"Room":[{"adult":2,"Children":[]}]}';
$b = json_decode($a,true);


$tp = new PackagesAPI('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpIjoiNTAifQ.35LFiBOikbD0zQxSlXKe6_t2jltNxQc3FZm5cMGKssA');
echo "<pre>";
var_dump($tp->getPackageList($b));