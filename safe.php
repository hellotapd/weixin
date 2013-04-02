<?php

class Safe{
	/**
	 * 检验请求是否正确
	 * @return bool
	 */
	static function vaild() {
		if(!self::check_signature()){ return false;}
		$check = false;
		$post_str = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ? $GLOBALS["HTTP_RAW_POST_DATA"] : null;
		if( !empty($post_str) ) {
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$keyword = trim($postObj->Content);
			if(empty( $keyword )){ 
				self::key_empty_log();
			} else {
				$check = true;
			}

		} else {
			self::request_empty_log();
		}
		return $check;
	}

	/**
	 *请求为空的log记录
	 *
	 */
	static function request_empty_log() {

	}

	/**
	 *key为空的log记录
	 *
	 */
	static function key_empty_log() {

	}

	static function check_signature()
	{
		
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>