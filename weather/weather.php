<?php
	echo 'Weather'; 
	class Weather {
		function curl_file_get_contents($durl){
			 // $f = new SaeFetchurl();
			 //  $content = $f->fetch($durl);
			 //  if($f->errno() == 0)  $r=$content;
			 //  else $r=$f->errmsg();
			$r = file_get_contents($durl);
			echo $r;
		   return $r;
		}
		function wtrimall($str)//删除空格
		{
			$qian=array(" ","　","\t","\n","\r");$hou=array("","","","","");
			return str_replace($qian,$hou,$str);	
		}
		function wchangearray($arr)//对数组进行键值排序
		{
			foreach($arr as $v)
			{if(!trim($v))continue;
			$value[]=trim($v);}return $value;
		}
		function getweather($city,$data='data.txt')//获取天气预报内容
		{
			$urlarr=unserialize(file_get_contents($data));
			if($urlarr[$city])
			{
				$url = $urlarr[$city];$text=$city;
				$lines_string = $this->curl_file_get_contents($url);
				$lines_string = explode("<!--day",$lines_string);
				if(!$lines_string[1]){return "无法获取到该城市的天气信息!";exit;}
				$lines_string_3=explode("未来",$lines_string[3]);
				$lines_array =array(str_replace('1-->','',$lines_string[1]),str_replace('2-->','',$lines_string[2]),str_replace('3-->','',$lines_string_3[0]));
				for($i=0;$i< count($lines_array); $i ++)
				{
					$tiqian=array("℃","高温","低温");$tihou=array("度","","");$nowarray=str_replace($tiqian,$tihou,strip_tags($lines_array[$i]));
					$datearray=explode("日",$nowarray);$wtext[$i]=trim($datearray[0])."日";//获取日期
					$weather=explode("白天",$nowarray);$weather=explode("夜间",$weather[1]);
					$baiarr=wchangearray(explode("\r",$weather[0]));//白天天气
					$yearr=wchangearray(explode("\r",$weather[1]));//夜间天气
					if($baiarr[0]==$yearr[0]){$wtext[$i].=$baiarr[0];}else{$wtext[$i].=$baiarr[0]."转".$yearr[0];}//将天气添加到返回值里
					$wtext[$i].=$baiarr[1]."到".$yearr[1];//将气温添加到返回值里
					if($baiarr[2]==$yearr[2]){$wtext[$i].=$baiarr[2];}else{$wtext[$i].=str_replace("风","",$baiarr[2]."转".$yearr[2]);$wtext[$i].="风";}//将风向添加到返回值里
					if($baiarr[3]!="微风"){$wtext[$i].=$baiarr[3];}//将风力添加到返回值
				}
				return $text.implode("",$wtext);
			}else{
				return "无法获取到该城市的天气信息!";
			}
		}
		function wtext($city)
		{
			$date=date("Ymd");$arr=array(1);$weather_txt="saemc://".$date.".txt";$old=array();
			if(!file_exists($weather_txt)){file_put_contents($weather_txt,serialize($arr));}
			$old=unserialize(file_get_contents($weather_txt));
			if($old['city'] && strlen($old[$city])>30){return $old['value'];}
			else{
				$new=getweather($city);$newarr=array($city=>$new);
				file_put_contents($weather_txt,serialize(array_unique(array_merge($old,$newarr))));
				return $new;
			}
		}

	   /**
	     * 城市实时天气搜索    
	     * @作者：@CBD社区网    
	     * @city 地区名称、电话区号、城市拼音    
	     * @return xml    
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
	        //$resultStr = $this->creat_xml_response($contentStr);   
	        $resultStr = $contentStr;   
	        return $resultStr;   
	        }else{   
	            $errorMsg = "暂时还不能从你发送的消息中判断它是哪一座城市哦。";   
	            $resultStr = $this->creat_xml_response($errorMsg);  
	            //$resultStr = $this->creat_xml_response($contentStr);   
	        	$resultStr = $contentStr;  
	            return $resultStr;   
	        }   
	    }   
	}
	$city = !empty($_GET['city'])?$_GET['city']:'beijing';
	$weather = new Weather();
	$city_weather =  $weather->inquire_city_weather($city);
	echo $city_weather;

?>