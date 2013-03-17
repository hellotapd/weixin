<?php
require_once("text_message.php");

class DefaultMessage extends TextMessage{
	function __construct($data){ 
		parent::__construct($data);
	}

	function get_content() {
		$current_user = $this->current_user();
		$keyword = $this->keyword();
		$now = date("Y-m-d");
		return "Hello {$current_user},the time is {$now}, Welcome to tapd~~your keyword is \"{$keyword}\"~ ";
	}

}


?>