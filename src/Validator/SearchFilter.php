<?php

namespace TravelPAQ\PackagesAPI\Validator;

use TravelPAQ\PackagesAPI\Validator\Filter;

class SearchFilter 
{
	var $filter;
	var $schema;
	var $_last_error;
	function __construct($params) 
	{
		$this->schema = file_get_contents(__DIR__.'/../json/schemas/getPackageList.schema.json');
		$this->filter = new Filter($params);
	}

	public function validate()
	{
		$deref  = new \League\JsonGuard\Dereferencer();
		$schema = json_decode($this->schema);
		$schema = $deref->dereference($schema);
		$data = $this->filter;
		$validator = new \League\JsonGuard\Validator($data, $schema);
		if ($validator->fails()) 
		{
		    $this->_last_error = $validator->errors();
            return false;
		}
		return true;
	}
	public function get_last_error()
	{
		return $this->_last_error;
	}
}