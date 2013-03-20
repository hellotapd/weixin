<?php
//send mesage to index then return the response
class SendMessage {
	const $ip = 'weixin.ifxoxo.com';
	const $port = 10086;
	var $timeout = 10;
	function __construct($timeout) {
		$this->timeout = $timeout;
	}

	function send_message($str) {
		$fp = fsockopen(self::ip, self::port, 0, '', $this->timeout);
		if(!$fp) {
			return false;
		}
		
	}
}
?>
