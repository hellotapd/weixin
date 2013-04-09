<?php
	require_once("/var/www/weixin/message/lib/weather/weather.php");
	$city = !empty($_GET['city'])?$_GET['city']:'shenzhen';
	$weather = new Weather();
	$city_weather =  $weather->inquire_city_weather_str($city);
	echo $city_weather;

?>