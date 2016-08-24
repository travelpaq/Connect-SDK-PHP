<?php

namespace TravelPAQ\PackagesAPI\Validator;

use TravelPAQ\PackagesAPI\Validator\Book;

class BookData 
{
	var $data;
	var $schema;
	function __construct($params) 
	{
		$this->schema = file_get_contents(__DIR__.'/../json/schemas/bookingPackage.schema.json');
		$this->data = new Book($params);
	}

	public function validate()
	{
		$deref  = new \League\JsonGuard\Dereferencer();
		$schema = json_decode($this->schema);

		$schema = $deref->dereference($schema);

		$data = $this->data;

		$validator = new \League\JsonGuard\Validator($data, $schema);

		if ($validator->fails()) 
		{
            echo "<pre>";
            var_dump($validator->errors());
		    $this->_last_error = $validator->errors();
		}
		return $validator->passes();
	}
	public function get_last_error()
	{
		return $this->_last_error;
	}
}