<?php
require_once("text_message.php");

class DetailMessage extends TextMessage{
	function __construct($data){ 
		parent::__construct($data);
	}

	function get_content() {
		return "this is from detail_message";
	}

}


?>