<?php
class PicGirl extends PicMessage{
	function __construct($data){ 
		parent::__construct($data);
	}

	function get_content() {
		$content = array();
		for ($i=0; $i < 4; $i++) { 
			$content[] = $this->_get_one_item();	
		}
		return $content;	
	}

	function _get_one_item() {
		return array(
				'title' => " beautiful girl",
				'descript' => " this is a beautiful girl, you may like it",
				'pic_url' => "http://pic.pare.cn/p3/2013-03-25-16-12-40_fw580",
				'url' => "http://mp.weixin.qq.com/wiki/index.php?title=%E8%87%AA%E5%AE%9A%E4%B9%89%E8%8F%9C%E5%8D%95%E6%8E%A5%E5%8F%A3"
			);
	}

}


?>