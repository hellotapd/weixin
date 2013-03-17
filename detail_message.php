<?php
require_once("text_message.php");

class DetailMessage extends TextMessage{
	function __contruct($data){ 
		parent::__contruct($data);
	}

	function get_content() {
		return "this is from detail_message";
	}

}


?>