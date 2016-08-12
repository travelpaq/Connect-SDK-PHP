<?php

namespace TravelPAQ\Services\Service;

public class Service
{
	var $http_client;
    public function __construct() 
    {
        $this->http_client = HttpClient::getInstance();
    }

}
