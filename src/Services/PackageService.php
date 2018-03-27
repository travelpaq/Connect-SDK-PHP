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
							 ->request('GET', 'sliders');
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception($body);
			}
			$response = [];			
			foreach ($body_decoded['data'] as $key => $fixed) {
				$respon = [];
				$respon['id'] = $fixed['id']; 
				$respon['name'] = $fixed['name']; 
				$respon['active'] = $fixed['active']; 
				$respon['main'] = $fixed['main']; 
				$respon['packages'] = [];
				foreach($fixed['packages'] as $package){
					$respon['packages'][] = new Package($package);						
				}

				$response[] = $respon;
			}

			return $response;
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
			$packages = [];
			foreach($body_decoded as $package){
				$packages[] = new Package($package);
			}
			return $packages;
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}

	public function getPackageGroup($params, $groups = null,$page = 0,$filters = null){
		
		if(array_key_exists('order_field', $params) && $params['order_field'] === 'DEPARTURE_DATE')
			$params['order_field'] = 'DEPARTURE';
		/**
		* 
		* Formato v3
		*
		*/
		// rooms
		$room__ = [];
		foreach ($params['Room'] as $r => $room) {	
			$room__[$r]['adult'] = $room['adult'];
			if(array_key_exists('Children', $room)){ 
				if(count($room['Children']) > 0 ){ 
					foreach ($room['Children'] as $c => $child) {	
						$room__[$r]['children'][] = $child['age'];
					}
					$room__[$r]['children'] = implode(',', $room__[$r]['children']);
				}
			}
		}
		$params['rooms'] = $room__;
		unset($params['Room']);		
		$params_get_url = http_build_query($params);	
		
		
		// filters
		$filter__ = [];	
		if($filters){
			
			// hotel star rating

			foreach ($filters as $f => $filter) {
				
				switch ($filter['name']) {
					case 'companies':
						$filter__['companies']	= implode(',', $filter['companies']);			
						break;

					case 'hotel_names':
						$filter__['hotel_names']	= implode(',', $filter['hotel_names']);			
						break;

					case 'hotel_regimes':
						$filter__['hotel_regimes']	= implode(',', $filter['hotel_regimes']);			
						break;

					case 'hotel_room_kinds':
						$filter__['hotel_room_kinds']	= implode(',', $filter['hotel_room_kinds']);			
						break;

					case 'stars':
						$filter__['hotel_star_ratings']	= "{$filter['from']},{$filter['to']}";			
						break;

					case 'nights':
						$filter__['min_nights'] = $filter['from'];	
						$filter__['max_nights'] = $filter['to'];	
						break;

					case 'price':
						$filter__['min_price'] = $filter['from'];	
						$filter__['max_price'] = $filter['to'];	
						break;	

					case 'departure':
						$filter__['min_departure_date'] = date('Y-m-d',strtotime($filter['from']));
						$filter__['max_departure_date'] = date('Y-m-d',strtotime($filter['to']));		
						break;	
				}

			}
		}

		$filters_get_url = http_build_query($filter__);
		if(count($filter__)>0)
			$filters_get_url =  '&'.$filters_get_url;		
		
		// groups
		$groups_get_url = '';		
		if($groups)
			$groups_get_url =  '&'.http_build_query($groups);
		
		try {
			
			$response = $this->http_client
							 ->http_client
							 ->request('GET', 
							  		   "packages?{$params_get_url}{$filters_get_url}&page_index=$page{$groups_get_url}"
							 );
			
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
		if(array_key_exists('order_field', $params) && $params['order_field'] === 'DEPARTURE_DATE')
			$params['order_field'] = 'DEPARTURE';
		/**
		* 
		* Formato v3
		*
		*/
		// rooms
		$room__ = [];
		foreach ($params['Room'] as $r => $room) {	
			$room__[$r]['adult'] = $room['adult'];
			if(array_key_exists('Children', $room)){ 
				if(count($room['Children']) > 0 ){ 
					foreach ($room['Children'] as $c => $child) {	
						$room__[$r]['children'][] = $child['age'];
					}
					$room__[$r]['children'] = implode(',', $room__[$r]['children']);
				}
			}
		}
		$params['rooms'] = $room__;
		unset($params['Room']);		
		$params_get_url = http_build_query($params);	
		// +++++++++++
		$filter__ = [];	
		if($filters){
			
			// hotel star rating

			foreach ($filters as $f => $filter) {
				
				switch ($filter['name']) {
					case 'companies':
						$filter__['companies']	= implode(',', $filter['companies']);			
						break;

					case 'hotel_names':
						$filter__['hotel_names']	= implode(',', $filter['hotel_names']);			
						break;

					case 'hotel_regimes':
						$filter__['hotel_regimes']	= implode(',', $filter['hotel_regimes']);			
						break;

					case 'hotel_room_kinds':
						$filter__['hotel_room_kinds']	= implode(',', $filter['hotel_room_kinds']);			
						break;

					case 'stars':
						$filter__['hotel_star_ratings']	= "{$filter['from']},{$filter['to']}";			
						break;

					case 'nights':
						$filter__['min_nights'] = $filter['from'];	
						$filter__['max_nights'] = $filter['to'];	
						break;

					case 'price':
						$filter__['min_price'] = $filter['from'];	
						$filter__['max_price'] = $filter['to'];	
						break;	

					case 'departure':
						$filter__['min_departure_date'] = date('Y-m-d',strtotime($filter['from']));
						$filter__['max_departure_date'] = date('Y-m-d',strtotime($filter['to']));		
						break;	
				}

			}
		}
		$filters_get_url = http_build_query($filter__);
		if(count($filter__)>0)
			$filters_get_url =  '&'.$filters_get_url;				
			
		try {
			
			$response = $this->http_client
							 ->http_client
							 ->request('GET', 
							  		   "packages?{$params_get_url}&page_index=$page{$filters_get_url}"
							 );
			
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
		if(array_key_exists('order_field', $params) && $params['order_field'] === 'DEPARTURE_DATE')
			$params['order_field'] = 'DEPARTURE';

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

	public function getPackageListDateHotelGrouped($params, $page = 0, $filters = null){
		try {
			if($filters){
			    $response = $this->http_client
								 ->http_client
								 ->request('POST', 
								  		   'Packages/getPackageListDateHotelGrouped/' . $page,
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
								  		   'Packages/getPackageListDateHotelGrouped/' . $page,
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

			$response = $this->http_client->http_client->request('GET',"packages?package_id=$package_id");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
				throw new \Exception($body);
			}
			return new Package($body_decoded['package'][0]);
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
