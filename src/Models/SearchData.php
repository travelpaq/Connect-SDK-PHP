<?php

namespace TravelPAQ\PackagesAPI\Models;

class SearchData 
{
	var $search;
	var $schema;
	var $_last_error;
	function __construct($params) 
	{
		$this->schema = file_get_contents(__DIR__.'/../json/schemas/input/searchData.schema.json');
		$this->search = new Search($params);
	}

	public function validate()
	{
		$deref  = new \League\JsonGuard\Dereferencer();
		$schema = json_decode($this->schema);
		$schema = $deref->dereference($schema);
		$data = $this->search;
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
        $error = '';
        foreach ($this->_last_error as $i => $last_error) {
            if($i == count($this->_last_error) - 1){
                $error .= $last_error['pointer'].' '.$last_error['message'];
            } else {
                $error .= $last_error['pointer'].' '.$last_error['message'] . PHP_EOL;
            }
        }
		return $error;
	}
}