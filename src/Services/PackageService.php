<?php

namespace TravelPAQ\Services\PackageService;

use TravelPAQ\Services;

public class PackageService extends Services
{
	public static function all($params){
		$this->http_client
			 ->request('POST',
					   'search-engine/getPackageList/',
					   ['body' => json_encode($params)]);
		$body = $response->getBody();

	}
}
