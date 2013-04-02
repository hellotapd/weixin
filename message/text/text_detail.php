<?php
class TextDetail extends TextMessage{
	function __construct($data){ 
		parent::__construct($data);
	}

	function get_content() {
		$current_user = $this->current_user();
		$system_user = $this->system_user();
		$keyword = $this->keyword();
		$link = "<a href='".BASE_PATH."static".DS."pic".DS."test1.jpg'>查看美女</a>";
		$content = " hello ~~~ this is detail ~~ 点击 ".$link;
		return $content;
	}

}


?>