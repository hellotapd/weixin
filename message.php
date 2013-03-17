<?php

/**
 *消息回复 父类
 */
class Message{
	var $data;
	var $template;

	function __construct( $data, $template ){
		$this->$data = $data;
		$this->template = $template;
	}

	function set_template( $template) {
		$this->template = $template;
	}

	function get_template(){
		return $this->template;
	}

	// function create_msg() {
	// 	#do somethine here
	// }
}


?>