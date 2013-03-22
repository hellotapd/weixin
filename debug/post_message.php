<?php
/*
 *send message to index then return the response
 */
class SendMessage{
		const url = 'weixin.ifxoxo.com/index.php';
		var $timeout = 10;
		var $method = array('POST','GET');
		
		public function send_message($str) {
			$ch        =    curl_init();
			curl_setopt($ch,CURLOPT_URL,self::url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$str);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//...........
			curl_setopt($ch, CURLOPT_HEADER, false); 
      			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/xml', 'Content-Type: application/xml')); 
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
			curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
			$curl_result = curl_exec($ch);
			$xml = simplexml_load_string($curl_result);
			return $xml;
		}


}
