<?php
// require_once("../core.php");
class MessageFactory{
	static function init($post_data) {
		$postObj = simplexml_load_string($post_data, 'SimpleXMLElement', LIBXML_NOCDATA);
        $keyword = trim($postObj->Content);	
        $clas_name = self::_get_class_name($keyword);
        loadMessage($clas_name);
        return new $clas_name($postObj);
	}


	static function _get_class_name($keyword) {
		$messageObj = "TextDefault";
		if( $keyword == "detail") {
			$messageObj = "TextDetail";
		} else if( $keyword == "update") {
			$messageObj = "TextUpdate";
		} else if( $keyword == 'girl') {
			$messageObj = "PicGirl";
		}
		return $messageObj;
	}
}

?>