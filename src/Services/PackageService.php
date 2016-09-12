<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;
use TravelPAQ\PackagesAPI\Core\PackagesPagination;

class PackageService extends Service
{
	public function getPackageList($params, $page = 0){
		$response = $this->http_client
						 ->http_client
						 ->request('POST', 
						 		   'Packages/getPackageList/' . $page,
						 		   [
						 		   		'form_params' => 
						 		   		[
						 		   			'data' => base64_encode(json_encode($params))
						 		   		]
						 		   	]
						 );
		$body = $response->getBody()->getContents();
		echo $body;die();
		return new PackagesPagination(json_decode($body,true));
	}
	public function getPackage($id){
		$response = $this->http_client
						 ->http_client
						 ->request('GET',"Packages/getPackage/$id");
		$body = $response->getBody()
						 ->getContents();
		return $body;
	}
}
