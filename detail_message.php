<?php
require_once("text_message.php");

class DetailMessage extends TextMessage{
	function __construct($data){ 
		parent::__construct($data);
	}

	function get_content() {
		$current_user = $this->current_user();
		$system_user = $this->system_user();
		$keyword = $this->keyword();
		$content = "current_user:[{$current_user}]; system_user:[{$system_user}];keyword:[{$keyword}]";
		return $content;
	}

}


?>