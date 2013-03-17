<?php

/**
 *消息回复 父类
 */
class Message{
	var $data;
	var $template;

	function __construct( $data, $template ){
		$this->data = $data;
		$this->template = $template;
	}

	function set_template( $template) {
		$this->template = $template;
	}

	function get_template(){
		return $this->template;
	}

	function current_user() {
		return $this->data->FromUserName;
	}

	function system_user() {
		return $this->data->ToUserName;
	}

	function keyword() {
		return $this->data->Content;
	}
}


?>