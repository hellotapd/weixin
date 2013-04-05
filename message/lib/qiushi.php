<?php 
require_once("../../core.php");
$url = "http://feed.feedsky.com/qiushi";
// 创建一个新cURL资源
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_HEADER, false);
// $result = curl_exec($ch);
// $curl_error = curl_errno($ch);


// curl_close($ch);



$contents = file_get_contents($url); 
//如果出现中文乱码使用下面代码 
//$getcontent = iconv("gb2312", "utf-8",$contents); 
debug($contents);
?>