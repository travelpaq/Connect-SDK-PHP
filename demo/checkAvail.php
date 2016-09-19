<?php

	require "../vendor/autoload.php";
	use TravelPAQ\PackagesAPI\PackagesAPI;

	$tp = new PackagesAPI
		(
			[
				'api_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpIjoiNTAifQ.35LFiBOikbD0zQxSlXKe6_t2jltNxQc3FZm5cMGKssA',
				'item_per_page' => 10
			]
		);

	
	//Conversión de los parámetros
	try{
		$response = $tp->checkAvail($_GET["id"]);
		echo json_encode($response);
		//echo json_encode($response;
	} catch(Exception $e){
		echo $e->getMessage();
	}