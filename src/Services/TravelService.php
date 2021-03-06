<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use TravelPAQ\PackagesAPI\Models\Destinies;
use TravelPAQ\PackagesAPI\Models\Month;
use TravelPAQ\PackagesAPI\Models\Category;
use TravelPAQ\PackagesAPI\Models\ServiceKind;
use TravelPAQ\PackagesAPI\Models\FarePackage;
use TravelPAQ\PackagesAPI\Models\OriginPlaceFare;
use TravelPAQ\PackagesAPI\Models\PlaceFare;

class TravelService extends Service
{
	public function getPlaces($country_iata){
		try {
			$response = $this->http_client
						 ->http_client
						 ->request('GET',"travel/getPlaces/$country_iata");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if(!is_array($body_decoded) && $body_decoded == null){
				throw new \Exception($body);
			}
			return new Destinies($body_decoded);	
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}

	public function getCategories(){
		try {
			$response = $this->http_client
						 ->http_client
						 ->request('GET',"travel/getCategories");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if(!is_array($body_decoded) && $body_decoded == null){
				throw new \Exception($body);
			}
			$categories = [];
			foreach($body_decoded as $category){
				$categories[] = new Category($category);	
			}

			return $categories;
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}

	public function getServiceKinds(){
		try {
			$response = $this->http_client
						 ->http_client
						 ->request('GET',"travel/getServiceKinds");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if(!is_array($body_decoded) && $body_decoded == null){
				throw new \Exception($body);
			}

			$serviceKinds = [];
			foreach($body_decoded as $serviceKind){
				$serviceKinds[] = new ServiceKind($serviceKind);	
			}
			return $serviceKinds;
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}


	public function getMonthByPlaces($place_iata){
		try {
			$response = $this->http_client
						 ->http_client
						 ->request('GET',"travel/getMonthByPlaces/$place_iata");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if(!is_array($body_decoded) && $body_decoded == null){
				throw new \Exception($body);
			}
			$months = array();
			foreach ($body_decoded as $month) {
				$months[] = new Month($month);
			}

			return $months;
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}

	public function getFaresPackage($origin_iata, $departure_iata, $month, $year){
		try {
			if(!$origin_iata || !$departure_iata || !$month || !$year)
				throw new RequestException("Se requiere que especifique los códigos IATA de las ciudades de salida y llegada y el mes/año", 1);
				
			$response = $this->http_client
						 ->http_client
						 ->request('GET',"travel/getFaresPackage/$origin_iata/$departure_iata/$month/$year");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if(!is_array($body_decoded) && $body_decoded == null){
				throw new \Exception($body);
			}
			
			$faresPackage = array();
			foreach ($body_decoded as $farePackage) {
				$faresPackage[] = new FarePackage($farePackage);
			}

			return $faresPackage;
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}

	public function getPlacesWithPackage($country_iata){

		try {
			$response = $this->http_client
						 ->http_client
						 ->request('GET',"travel/getPlacesWithPackage/$country_iata");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if(!is_array($body_decoded) && $body_decoded == null){
				throw new \Exception($body);
			}
			return new Destinies($body_decoded);	
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}

	public function getFaresTree(){

		try {
			$response = $this->http_client
						 ->http_client
						 ->request('GET',"fares");

			$body = $response->getBody()->getContents();

			$body_decoded = json_decode($body,true);
			if(!is_array($body_decoded) && $body_decoded == null){
				throw new \Exception($body);
			}
			$faresTree = [];

			foreach($body_decoded as $fares){
				$faresTree[] = new PlaceFare($fares);
			}

			return $faresTree;
			
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}

	public function getFaresTreeWithOrigin($iata){
		
		try {

			$response = $this->http_client
						 ->http_client
						 ->request('GET',"fares/with_origin" . $iata);
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
						
			if(!is_array($body_decoded) && $body_decoded == null){
				throw new \Exception($body);
			}
			$faresTree = [];



			foreach($body_decoded['data'] as $fares){
				$faresTree[] = new OriginPlaceFare($fares);
			}

			return $faresTree;
			
		} catch (RequestException $e) {
			$response_str = "";
			if ($e->hasResponse())
				$response_str = $e->getResponse()->getBody()->getContents();
			return $response_str;
		}
	}
}