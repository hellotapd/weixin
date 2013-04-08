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
	     * 城市实时天气搜索    
	     * @作者：@andycwang    
	     * @city 地区名称、城市拼音    
	     * @return array     
	    */     
	   public function inquire_city_weather_array($city)   
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
		        $weather_arr = json_decode($weatherjson);
		        return $weather_arr;   
	        }else{   
	        	$error_msg = array('msg' => '暂时还不能从你发送的消息中判断它是哪一座城市哦。'); 
	        	if($city == 'beijing' || $city == '北京') {
	        		$error_msg = array('msg' => '亲，北京市好大哦！请选一个区进行查询：东城、西城、崇文、宣武、朝阳、海淀、丰台、石景山、顺义、昌平、门头沟、通州、房山、大兴、怀柔、平谷、延庆、密云'); 
	        	}
	            return $error_msg;   
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
	   	/**
	     * 天气和中文关键词映射
	     * @作者：@andycwang   
	     * @key 天气中文     
	     * @return string    
	    */  
	    function get_weather_index($key){
	    	$weather_key_array = array(
	    		'地点' => array('city', 'city_en'),
	    		'时间' => array('date_y','week'),
	    		'气温' => array('temp1'),
	    		'天气描述' => array('weather1'),
	    		'穿衣' => array('index'， 'index_d'),
	    		'风速' => array('wind1'),
	    		'紫外线' => array('index_uv'),
	    		'洗车' => array('index_xc'),
	    		'旅行' => array('index_tr'),
	    		'舒适' => array('index_co'),
	    		'晨练' => array('index_cl'),
	    		'晾晒' => array('index_ls'),
	    		'过敏' => array('index_ag'),
	    		'天气' => array('city', 'date_y', 'week', 'temp1','weather1','wind1','index','index_d','index_uv', 'index_xc', 'index_tr',
	    			'index_co', 'index_cl', 'index_ls', 'index_ag');
	    		);
	    	if(!empty($weather_key_array[$key])) {
	    		return $weather_key_array[$key];
	    	} else {
	    		return array();
	    	}
	    }

	   	/**
	     * 处理天气预报要播报的字符串
	     * @作者：@andycwang   
	     * @weather_arr 天气内容数组
	     * @return string    比较通顺的天气预报语句
	    */  
	    function handel_weather_report_str($weather_arr) {
	    	$weather_report_str = '';
	    	foreach ($weather_arr as $key => $value) {
	    		switch ($key) {
	    			case 'city':
	    				$weather_report_str .= '地点：'.$value.' ';
	    				break;
	    			case 'city_en':
	    				$weather_report_str .= '地点拼音：'.$value.' ';
	    				break;
	    			case 'date_y':
	    				$weather_report_str .= '日期：'.$value.' ';
	    				break;	    
	    			case 'week':
	    				$weather_report_str .= '星期：'.$value.' ';
	    				break;
	    			case 'temp1':
	    				$weather_report_str .= '气温：'.$value.' ';
	    				break;
	    			case 'weather1':
	    				$weather_report_str .= '天气详情：'.$value.' ';
	    				break;
	    			case 'wind1':
	    				$weather_report_str .= '风力：'.$value.' ';
	    				break;
	    			case 'index':
	    				$weather_report_str .= '天气'.$value.' ';
	    				break;
	    			case 'index_d':
	    				$weather_report_str .= '穿衣指数：'.$value.' ';
	    				break;
	    			case 'index_uv':
	    				$weather_report_str .= '紫外线指数：'.$value.' ';
	    				break;
	    			case 'index_xc':
	    				$weather_report_str .= $value.'洗车 ';
	    				break;
	    			case 'index_tr':
	    				$weather_report_str .= $value.'旅行 ';
	    				break;	
	    			case 'index_co':
	    				$weather_report_str .= '舒适度：'.$value.' ';
	    				break;	
	    			case 'index_cl':
	    				$weather_report_str .= $value.'晨练 ';
	    				break;		
	    			case 'index_ls':
	    				$weather_report_str .= $value.'晾晒 ';
	    				break;		
	    			case 'index_ag':
	    				$weather_report_str .= $value.'过敏 ';
	    				break;					
	    			default:
	    				break;
	    		}
	    	}
	    	return $weather_report_str;
	    }

	   	/**
	     * 设置将要使用的天气信息字段
	     * @作者：@andycwang   
	     * @weather_arr 所有天气内容数组
	     * @weather_fields_arr 设置要显示的域
	     * @return array 返回经过筛选的天气数组
	    */  
	    function set_used_weather_field_array($weather_arr, $weather_fields_key_arr ) {
	    	$used_weather_field_array = array();
	    	// foreach ($weather_arr as $key => $value) {
	    	// 	if(in_array($key, $weather_fields_key_arr)) {
	    	// 		$used_weather_field_array = array_merge($used_weather_field_array,array($key => $value));
	    	// 	}	
	    	// }
			foreach ($weather_fields_key_arr as $key => $value) {
				if(!empty($weather_arr[$value])) {
					$used_weather_field_array = array_merge($used_weather_field_array,array($value => $weather_arr[$value]));
				}
			}
			return $used_weather_field_array;
	    }

	//     	$weather_key_array = array(
	// "city":"海淀",              //地点
	// "city_en":"haidian",		//地点英文名
	// "date_y":"2013年4月8日",	//当前日期
	// "week":"星期一",			//星期几
	// "cityid":"101010200",		//城市码
	// "temp1":"4℃~13℃",			//气温摄氏
	// "weather1":"多云",			//天气描述
	// "wind1":"北风4-5级", 		//风速描述
	// "index":"较冷",				//穿衣指数
	// "index_d":"建议着厚外套加毛衣等服装。年老体弱者宜着大衣、呢外套加羊毛衫。",//穿衣指数
	// "index_uv":"最弱",     		//紫外线指数
	// "index_xc":"较适宜",   		//洗车指数
	// "index_tr":"适宜",			//旅行指数
	// "index_co":"较舒适",		//舒适指数
	// "index_cl":"较适宜",		//晨练
	// "index_ls":"基本适宜",		//晾晒
	// "index_ag":"较易发"}}		//过敏
	//     		);

	}

?>