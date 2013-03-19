<?php
require_once("text_message.php");

class UpdateMessage extends TextMessage{
	var $file_dir = "/var/www/weixin/";
	var $git_remote_name = "origin";
	function __construct($data){ 
		parent::__construct($data);
	}

	function get_content() {
		if($this->vaild()) {
			return $this->_update_git();
		} else {
			return "sorry!! You don't have the authority required. Please contact Kerwin if need is";
		}
	}

	private function vaild(){
		$current_user = $this->current_user();
		$allow_user = array(
			"oVdr7jqVL5qD3NdnueKTmN2toAqc"	//kerwin
			);
		return in_array($current_user,$allow_user);
	}

	private function _update_git() {
		$update_command = "cd {$this->file_dir} && git pull {$this->git_remote_name} 2>&1";
		return system($update_command);
	}

}


?>