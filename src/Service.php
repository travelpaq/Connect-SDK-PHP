<?php

namespace TravelPAQ\Service;

public class Service
{
	var $instance = null;

    public static getInstance($params = []){
    	if(count($params) > 0 ) {
    		$instance = new Service();
    	}
    	return $instance;
    } 
    private function __construct()
    {
    	throw new Exception("Singleton", 1);
    	
    }
}
