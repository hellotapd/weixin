<?php
require_once("/var/www/weixin/message/lib/weather/weather.php");

class TextDefault extends TextMessage{
	function __construct($data){ 
		parent::__construct($data);
	}

	function get_content() {
		$current_user = $this->current_user();
		$keyword = $this->keyword();
		$now = date("Y-m-d");
		//根据城市获取天气
		$city = !empty($keyword)?$keyword:'shenzhen';
		$weather = new Weather();
		$city_weather =  $weather->inquire_city_weather_str($city);
		return $city_weather;
		return "Hello {$current_user},the time is {$now}, Welcome to tapd~~your keyword is \"{$keyword}\"~ ";
	}

}


?>