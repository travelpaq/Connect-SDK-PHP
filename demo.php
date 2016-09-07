<?php

require "vendor/autoload.php";

use TravelPAQ\PackagesAPI\PackagesAPI;
if(isset($_GET['page'])){
	$page = $_GET['page'];
}else
{
	$page = 0;
}
$a = '{"order_type":"ASC","order_field":"PRICE","currency":"USD","origin_place":"EZE","destination_place":"IGR","month_departure":9,"year_departure":2016,"Room":[{"adult":2,"Children":[]}]}';

$b = json_decode($a,true);

$tp = new PackagesAPI(['api_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpIjoiNTAifQ.35LFiBOikbD0zQxSlXKe6_t2jltNxQc3FZm5cMGKssA',
					   'item_per_page' => 2]);
echo "<pre>";
$x = $tp->getPackageList($b,$page);
//$x = $tp->getPackage($page);
echo json_encode(json_decode($x),JSON_PRETTY_PRINT);