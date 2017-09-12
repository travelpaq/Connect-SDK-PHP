<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;
use TravelPAQ\PackagesAPI\Models\PackagesPagination;
use TravelPAQ\PackagesAPI\Models\Package;
use TravelPAQ\PackagesAPI\Models\DestinyResultPagination;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class PackageService extends Service
{
	public function getPackageByFixedSearches(){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('GET', 'Packages/getPackageByFixedSearches');
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception($body);
			}
			return $body_decoded;
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}

	public function getPackageByFixedSearch($name, $page){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('GET', 'Packages/getPackageByFixedSearch/' . $name . '/' . $page);
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

	public function getPackageListDateGrouped($params, $page = 0, $filters = null){
		try {
			if($filters){
			    $response = $this->http_client
								 ->http_client
								 ->request('POST', 
								  		   'Packages/getPackageListDateGrouped/' . $page,
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
								  		   'Packages/getPackageListDateGrouped/' . $page,
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

	public function getPackagesGrouped($params, $type, $page, $main_group_by , $secondary_group_by){
		try {
			$response = $this->http_client
							 ->http_client
							 ->request('POST', 
							  		   'Packages/getPackagesGrouped/' . $type . '/' . $page . '/' . $main_group_by . '/' . $secondary_group_by,
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
			return new DestinyResultPagination($body_decoded);
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
