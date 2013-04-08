<?php
/**
 * Weather类，用于封装与天气有关的操作    
 * @作者：@andycwang    
 * @city 地区名称、城市拼音    
 * @return xml    
*/   
	class Weather {
	   /**
	     * 城市实时天气搜索    
	     * @作者：@andycwang    
	     * @city 地区名称、城市拼音    
	     * @return string    
	    */     
	   public function inquire_city_weather_str($city)   
	    {   
	  		$post_data = array();   
	        $post_data['city'] = $city;   
	        $post_data['submit'] = "submit";   
	        $url = 'http://search.weather.com.cn/wap/search.php';   
	        $o = "";   
	        foreach ($post_data as $k => $v) {   
	            $o .= "$k=" . urlencode($v) . "&";   
	        }   
	        $post_data = substr($o, 0, -1);   
	        $ch = curl_init();   
	        curl_setopt($ch, CURLOPT_POST, 1);   
	        curl_setopt($ch, CURLOPT_HEADER, 0);   
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
	        curl_setopt($ch, CURLOPT_URL, $url);   
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);   
	        $result = curl_exec($ch);   
	        curl_close($ch);   
	        $result = explode('/', $result);   
	        $result = explode('.', $result['5']);   
	        $citynum = $result['0'];   
	        if($citynum != 101010100){   
		        $weatherurl = "http://m.weather.com.cn/data/" . $citynum . ".html";   
		        $weatherjson = file_get_contents($weatherurl);   
		        $weatherarray = json_decode($weatherjson, true);   
		        $weatherinfo = $weatherarray['weatherinfo'];   
		        $contentTpl = "#这里是%s#(%s)
					%s%s  
					%s时发布的天气预报：  
					今天天气：%s  
					%s，%s  
					穿衣指数：%s  
					紫外线指数：%s  
					洗车指数：%s  
					明天天气：%s  
					%s，%s  
					后天天气：%s  
					%s，%s";   
		        $content_str = sprintf($contentTpl, $weatherinfo['city'], $weatherinfo['city_en'],   
		            $weatherinfo['date_y'], $weatherinfo['week'], $weatherinfo['fchh'], $weatherinfo['temp1'],   
		            $weatherinfo['weather1'], $weatherinfo['wind1'], $weatherinfo['index_d'], $weatherinfo['index_uv'],   
		            $weatherinfo['index_xc'], $weatherinfo['temp2'], $weatherinfo['weather2'], $weatherinfo['wind2'],   
		            $weatherinfo['temp3'], $weatherinfo['weather3'], $weatherinfo['wind3']);                   
		        $result_str = $content_str;   
		        return $result_str;   
	        }else{   
	        	$error_msg = "暂时还不能从你发送的消息中判断它是哪一座城市哦。";  
	        	if($city == 'beijing' || $city == '北京') {
					$error_msg = "亲，北京市好大哦！请选一个区进行查询：东城、西城、崇文、宣武、朝阳、海淀、丰台、石景山、顺义、昌平、门头沟、通州、房山、大兴、怀柔、平谷、延庆、密云";  
	        	}
	        	$result_str = $error_msg;  
	            return $result_str;   
	        }   
	    }  

	   /**
	     * 城市实时天气搜索    
	     * @作者：@andycwang    
	     * @city 地区名称、城市拼音    
	     * @return json     
	    */     
	   public function inquire_city_weather_json($city)   
	    {   
	  		$post_data = array();   
	        $post_data['city'] = $city;   
	        $post_data['submit'] = "submit";   
	        $url = 'http://search.weather.com.cn/wap/search.php';   
	        $o = "";   
	        foreach ($post_data as $k => $v) {   
	            $o .= "$k=" . urlencode($v) . "&";   
	        }   
	        $post_data = substr($o, 0, -1);   
	        $ch = curl_init();   
	        curl_setopt($ch, CURLOPT_POST, 1);   
	        curl_setopt($ch, CURLOPT_HEADER, 0);   
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
	        curl_setopt($ch, CURLOPT_URL, $url);   
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);   
	        $result = curl_exec($ch);   
	        curl_close($ch);   
	        $result = explode('/', $result);   
	        $result = explode('.', $result['5']);   
	        $citynum = $result['0'];   
	        if($citynum != 101010100){   
		        $weatherurl = "http://m.weather.com.cn/data/" . $citynum . ".html";   
		        $weatherjson = file_get_contents($weatherurl);   
		        return $weatherjson;   
	        }else{   
	        	$error_msg = array('msg' => '暂时还不能从你发送的消息中判断它是哪一座城市哦。'); 
	        	if($city == 'beijing' || $city == '北京') {
	        		$error_msg = array('msg' => '亲，北京市好大哦！请选一个区进行查询：东城、西城、崇文、宣武、朝阳、海淀、丰台、石景山、顺义、昌平、门头沟、通州、房山、大兴、怀柔、平谷、延庆、密云'); 
	        	}
	        	$result_json = json_encode($error_msg);
	            return $result_json;   
	        }   
	    }  

	   	/**
	     * 针对北京市只有各个区的查询，需要特殊处理、默认为海淀
	     * @作者：@andycwang   
	     * @city 地区名称、城市拼音     
	     * @return string    
	    */     
	    function handle_city($city = '') {
	    	$ret_city = '';
	    	if($city == 'beijing' || $city == '北京') {
	    		$ret_city = '海淀';
	    	}
	    	return $ret_city;
	    }

	}

?>