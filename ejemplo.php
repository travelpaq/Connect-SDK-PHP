<?php

require "vendor/autoload.php";

use TravelPAQ\PackagesAPI\PackagesAPI;

$a = '{"order_type":"ASC","order_field":"PRICE","currency":"ARS","origin_place":"EZE","destination_place":"CUN","month_departure":12,"year_departure":2016,"Room":[{"adult":2,"Children":[{"age":3},{"age":14}]}]}';
$b = json_decode($a,true);


$tp = new PackagesAPI('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpIjoiNTAifQ.35LFiBOikbD0zQxSlXKe6_t2jltNxQc3FZm5cMGKssA');
echo $tp->getPackageList($b);