<?php
	echo 'Weather'; 
	class Weather {
	   /**
	     * 城市实时天气搜索    
	     * @city 地区名称、电话区号、城市拼音      
	    */     
	   public function inquire_city_weather($city)   
	    {   
	  		$post_data = array();   
	        $post_data['city'] = $city;   
	        echo $city;
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
	        $contentStr = sprintf($contentTpl, $weatherinfo['city'], $weatherinfo['city_en'],   
	            $weatherinfo['date_y'], $weatherinfo['week'], $weatherinfo['fchh'], $weatherinfo['temp1'],   
	            $weatherinfo['weather1'], $weatherinfo['wind1'], $weatherinfo['index_d'], $weatherinfo['index_uv'],   
	            $weatherinfo['index_xc'], $weatherinfo['temp2'], $weatherinfo['weather2'], $weatherinfo['wind2'],   
	            $weatherinfo['temp3'], $weatherinfo['weather3'], $weatherinfo['wind3']);                   
	       // $resultStr = $this->creat_xml_response($contentStr);   
	        $resultStr = $contentStr;  
	        return $resultStr;   
	        }else{   
	            $errorMsg = "暂时还不能从你发送的消息中判断它是哪一座城市哦。";   
	           // $resultStr = $this->creat_xml_response($errorMsg);  
	            $resultStr = $errorMsg;    
	            return $resultStr;   
	        }   
	    } 
	    /**
	     * 获取城市    
	    */    

	    function get_city_name(){

		}  
	}

	$city = 'beijing';
	if(!empty($_GET['city'])){
		$city = $_GET['city']; 
	}
	$weather = new Weather();
	$city_weather =  $weather->inquire_city_weather('qingdao');
	echo $city_weather;
?>