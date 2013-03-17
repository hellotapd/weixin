<?php
require_once("text_message.php");

class UpdateMessage extends TextMessage{
	function __construct($data){ 
		parent::__construct($data);
	}

	function get_content() {
		if($this->vaild()) {
			
		}
		$current_user = $this->current_user();
		$system_user = $this->system_user();
		$keyword = $this->keyword();
		$content = "current_user:[{$current_user}]; system_user:[{$system_user}];keyword:[{$keyword}]";
		return $content;
	}

	private function vaild(){
		$current_user = $this->current_user();
		$allow_user = array(
			"oVdr7jqVL5qD3NdnueKTmN2toAqc"	//kerwin
			);
		return in_array($current_user,$allow_user);
	}

}


?>