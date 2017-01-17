<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;
use TravelPAQ\PackagesAPI\Models\PackagesPagination;
use TravelPAQ\PackagesAPI\Models\Package;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class PackageService extends Service
{
	public function getPackageList($params, $page = 0, $filters = null){
		try {
			if($filters){
			    $response = $this->http_client
								 ->http_client
								 ->request('POST', 
								  		   'Packages/getPackageList/' . $page,
								  		   [
								  		   		'form_params' => 
								  		   		[
								  		   			'data' => base64_encode(json_encode($params))
								  		   		],
								  		   		'headers' => ['TP-FILTERS' => base64_encode(json_encode($filters))]
								  		   	]
								 );
			} else {
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
			}
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception($body);
			}
			return new PackagesPagination($body_decoded);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}
	
	public function getPackage($package_id){
		try {

			$response = $this->http_client->http_client->request('GET',"Packages/getPackage/$package_id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception($body);
			}
			return new Package($body_decoded);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}
}
