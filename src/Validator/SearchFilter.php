<?php 
	

	 class Child
	{
	     $age; //int
	}

	 class Room
	{
	    var $adult; //int
	    var $Children; //array(Child)
	}

	class Data
	{
		var $order_type;
		var $order_field;
		var $currency;
		var $origin_place;
		var $destination_place;
		var $month_departe;
		var $year_departure;
		var $Room;
		function _construct($params){
			$this->order_type = $param['order_type'];
			$this->order_field = $param['order_field'];
			$this->currency = $param['currency'];
			$this->origin_place = $param['origin_place'];
			$this->destination_place = $param['destination_place'];
			$this->month_departe = $param['month_departe'];
			$this->year_departure = $param['year_departure'];
			$this->Room = (array)($param['Room']);
			foreach($this->Room as &$room){
				$room['Child'] = (array)($room['Child']);
			}
		}
	}



     class SearchFilter {
   		var $data;
   		var $schema = '{"$schema":"http://json-schema.org/draft-04/schema#","type":"object","properties":{"order_field":{"type":"string","enum":["PRICE","DAPARTURE_DATE"],},"order_type":{"type":"string","enum":["ASC","DESC"],},"currency":{"type":"string","enum":["EUR","USD","ARS"],},"origin_place":{"type":"string","minLength":2,"maxLength":3,},"destination_place":{"type":"string","minLength":2,"maxLength":3,},"month_departure":{"type":"integer","minimum":1,"maximum":12,},"year_departure":{"type":"integer",},"Room":{"type":"array","minItems":1,"maxItems":4,"items":{"type":"object","properties":{"adult":{"type":"integer","minimum":1,"maximum":8,},"Children":{"type":"array","minItems":1,"maxItems":8,"items":{"type":"object","properties":{"age":{"type":"integer","minimum":0,"maximum":17,}},"required":["age"]}}},"required":["adult","Children"]}}},"required":["order_type","order_field","currency","origin_place","destination_place","month_departure","year_departure","Room"]}';
		function _contruct($params){
			$data = new Data($params)
		}

		public function validate(){
			return Jsv4::validate(json_encode($this->data), $this->schema);
		}
   }