<?php

namespace TravelPAQ\PackagesAPI\Services;

 class Service
{
	var $http_client;
    public function __construct() 
    {
        $this->http_client = HttpClient::getInstance();
    }

}
