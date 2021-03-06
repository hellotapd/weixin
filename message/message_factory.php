<?php
// require_once("../core.php");
require_once("lib/keywords/SplitWords.php");
require_once("lib/keywords/dictionary.php");
class MessageFactory{
    static function init($post_data) {
        global $dic;
        $postObj = simplexml_load_string($post_data, 'SimpleXMLElement', LIBXML_NOCDATA);
        $keyword = trim($postObj->Content);
        $split = new SplitWords();
        $split->dic = $dic;
        $split->MaxLen = 5;
        $split->MinLen = 2;
        $keywords = $split->split((string)$keyword);
        debug($keywords);
        $clas_name = self::_get_class_name($keyword);
        loadMessage($clas_name);
        return new $clas_name($postObj);
    }


	static function _get_class_name($keyword) {
		$default = "TextDefault";
		$key_map = self:: _key_word_map();
		foreach ($key_map as $mobj => $keys) {
			foreach ($keys as $key ) {
				if( strpos($keyword, $key) !== FALSE) {
					return $mobj;
				}
			}
		}
		return $default;
	}

	static function _key_word_map() {
		$map = array(
			'TextDetail' => array("detail"),
			'TextQiushi' => array("笑话","糗事","xh"),
			'PicGirl' => array("美女","girl", "图片")

		);
		return $map;
	}



}

?>
