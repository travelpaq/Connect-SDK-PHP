<?php

namespace TravelPAQ\PackagesAPI\Services;

use TravelPAQ\PackagesAPI\Services\Service;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use TravelPAQ\PackagesAPI\Models\Destinies;

class TravelService extends Service
{
	public function getPlaces($country_iata){
		try {
			$response = $this->http_client
						 ->http_client
						 ->request('GET',"travel/getPlaces/$country_iata");
			$body = $response->getBody()->getContents();
			$body_decoded = json_decode($body,true);
			if($body_decoded == null){
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
}