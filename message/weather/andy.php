<?php
	$city = !empty($_GET['city'])?$_GET['city']:'haidian';
	$weather = new Weather();
	$city_weather =  $weather->inquire_city_weather_str($city);
	echo $city_weather;
	$city_weather =  $weather->inquire_city_weather_json($city);
	echo $city_weather;
?>