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
			curl_setopt($ch, CURLOPT_POSTFIELDS, $str);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//...........
			$curl_result = curl_exec($ch);
			echo '<br>';
			echo 'result is :'.$curl_result;
		}


}
