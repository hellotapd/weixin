<?php
loadLib("qiushi");
class TextQiushi extends TextMessage{

	function __construct($data){ 
		parent::__construct($data);
	}

	function get_content() {
		$qiushi_obj = new Qiushi();
		return $qiushi_obj->get_qiushi();
	}

	

}


?>