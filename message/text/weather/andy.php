<?php
	require_once("/var/www/weixin/message/lib/weather/weather.php");
	$city = !empty($_GET['city'])?$_GET['city']:'shenzhen';
	$weather = new Weather();
	$city_weather =  $weather->inquire_city_weather_str($city);
	echo $city_weather;
	$city_weather =  $weather->inquire_city_weather_json($city);
	echo $city_weather;



// '#这里是海淀#(haidian) 2013年4月8日星期一 18时发布的天气预报： 今天天气：4℃~13℃ 多云，北风4-5级 穿衣指数：建议着厚外套加毛衣等服装。年老体弱者宜着大衣、呢外套加羊毛衫。 紫外线指数：最弱 洗车指数：较适宜 明天天气：4℃~14℃ 多云转晴，北风3-4级 后天天气：2℃~18℃ 晴，微风
// '
// {"weatherinfo":{

// 	"city":"海淀",              //地点
// 	"city_en":"haidian",		//地点英文名
// 	"date_y":"2013年4月8日",	//当前日期
// 	"date":"",
// 	"week":"星期一",			//星期几
// 	"fchh":"18",
// 	"cityid":"101010200",		//城市码
// 	"temp1":"4℃~13℃",			//气温摄氏
// 	"temp2":"4℃~14℃",
// 	"temp3":"2℃~18℃",
// 	"temp4":"6℃~21℃",
// 	"temp5":"7℃~21℃",
// 	"temp6":"8℃~16℃",
// 	"tempF1":"39.2℉~55.4℉",	//气温华氏
// 	"tempF2":"39.2℉~57.2℉","
// 	tempF3":"35.6℉~64.4℉",
// 	"tempF4":"42.8℉~69.8℉",
// 	"tempF5":"44.6℉~69.8℉",
// 	"tempF6":"46.4℉~60.8℉",
// 	"weather1":"多云",			//天气
// 	"weather2":"多云转晴",
// 	"weather3":"晴",
// 	"weather4":"多云",
// 	"weather5":"晴",
// 	"weather6":"阴",
// 	"img1":"1",
// 	"img2":"99",
// 	"img3":"1",
// 	"img4":"0",
// 	"img5":"0",
// 	"img6":"99",
// 	"img7":"1",
// 	"img8":"99",
// 	"img9":"0",
// 	"img10":"99",
// 	"img11":"2",
// 	"img12":"99",
// 	"img_single":"1",
// 	"img_title1":"多云",
// 	"img_title2":"多云",
// 	"img_title3":"多云",
// 	"img_title4":"晴",
// 	"img_title5":"晴",
// 	"img_title6":"晴",
// 	"img_title7":"多云",
// 	"img_title8":"多云",
// 	"img_title9":"晴",
// 	"img_title10":"晴",
// 	"img_title11":"阴",
// 	"img_title12":"阴",
// 	"img_title_single":"多云",
// 	"wind1":"北风4-5级", 	//刮风情况
// 	"wind2":"北风3-4级",
// 	"wind3":"微风",
// 	"wind4":"微风",
// 	"wind5":"微风",
// 	"wind6":"微风",
// 	"fx1":"北风",			//风向
// 	"fx2":"北风",
// 	"fl1":"4-5级",			//风力
// 	"fl2":"3-4级",
// 	"fl3":"小于3级",
// 	"fl4":"小于3级",
// 	"fl5":"小于3级",
// 	"fl6":"小于3级",
// 	"index":"较冷",
// 	"index_d":"建议着厚外套加毛衣等服装。年老体弱者宜着大衣、呢外套加羊毛衫。",
// 	"index48":"冷",
// 	"index48_d":"天气冷，建议着棉服、羽绒服、皮夹克加羊毛衫等冬季服装。年老体弱者宜着厚棉衣、冬大衣或厚羽绒服。",
// 	"index_uv":"最弱",
// 	"index48_uv":"中等",
// 	"index_xc":"较适宜",
// 	"index_tr":"适宜",
// 	"index_co":"较舒适",
// 	"st1":"13",
// 	"st2":"3",
// 	"st3":"13",
// 	"st4":"4",
// 	"st5":"18",
// 	"st6":"4",
// 	"index_cl":"较适宜",
// 	"index_ls":"基本适宜",
// 	"index_ag":"较易发"}}


?>