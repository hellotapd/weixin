<?php
class PicGirl extends PicMessage{
	function __construct($data){ 
		parent::__construct($data);
	}

	function get_content() {
		$content = array();
		for ($i=1; $i < 4; $i++) { 
			$content[] = $this->_get_one_item("test".$i.".jpg");	
		}
		return $content;	
	}

	function _get_one_item($pic_name) {
		return array(
				'title' => " beautiful girl",
				'descript' => " this is a beautiful girl, you may like it",
				'pic_url' => BASE_PATH."static".DS."pic".DS.$pic_name,
				'url' =>  BASE_PATH."static".DS."pic".DS.$pic_name
			);
	}

	function show_pic(){}

}


?>