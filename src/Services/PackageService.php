<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;
use TravelPAQ\PackagesAPI\Models\PackagesPagination;
use TravelPAQ\PackagesAPI\Models\Package;
use TravelPAQ\PackagesAPI\Models\DestinyResult;
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

	public function getDestinyList($params, $type, $page){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('POST', 
							  		   'Packages/getDestinyList/' . $type . '/' . $page,
							  		   [
							  		   		'form_params' => 
							  		   		[
							  		   			'data' => base64_encode(json_encode($params))
							  		   		]
							  		   	]
							 );
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception($body);
			}
			$destinyResults = [];
			foreach($body_decoded as $destinyResult){
				$destinyResults[] = new DestinyResult($destinyResult);
			}
			return $destinyResults;
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

	public function addPackage($package){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('POST', 
							  		   'Packages/add/',
							  		   [
							  		   		'form_params' => 
							  		   		[
							  		   			'data' => base64_encode(json_encode($package))
							  		   		]
							  		   	]
							 );
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception($body);
			}
			return new \TravelPAQ\PackagesAPI\Models\Input\Package ($body_decoded);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}

	public function editPackage($package){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('POST', 
							  		   'Packages/edit/',
							  		   [
							  		   		'form_params' => 
							  		   		[
							  		   			'data' => base64_encode(json_encode($package))
							  		   		]
							  		   	]
							 );
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception($body);
			}
			return new \TravelPAQ\PackagesAPI\Models\Input\Package ($body_decoded);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}

	public function viewPackage($package_id){
		try {

			$response = $this->http_client->http_client->request('GET',"Packages/view/$package_id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception($body);
			}
			return new \TravelPAQ\PackagesAPI\Models\Input\Package ($body_decoded);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}

	public function indexPackage(){
		try {

			$response = $this->http_client->http_client->request('GET',"Packages/index");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if(!is_array($body_decoded) && $body_decoded == null){
				throw new \Exception($body);
			}

			$packages = [];
			foreach($body_decoded as $package){
				$packages[] = new \TravelPAQ\PackagesAPI\Models\Input\Package ($package);
			}
			return $packages;
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}

	public function deletePackage($package_id){
		try {

			$response = $this->http_client->http_client->request('GET',"Packages/delete/$package_id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception($body);
			}
			return new \TravelPAQ\PackagesAPI\Models\Input\Package ($body_decoded);
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}
}
