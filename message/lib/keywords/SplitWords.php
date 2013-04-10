<?php
class SplitWords{
	var $MaxLen = 3;			//字典里字符串的最大长度
	var $MinLen = 2;			//最小长度
	var $MatchMaxFirst = true;	//是否优先匹配最长字符串 如“心电图”和“心电”，true的时候匹配出心电图，false的时候匹配出心电
	var $dic = array();			//字典


	/**
	 * 将字符串拆成一个字符一个值的数组
	 * 
	 * @author sunson
	 */
	function _deal_str_to_arr($str) {
		//中文字符的正则表达式
		$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
		preg_match_all($pa, $str, $t_string);
		return $t_string[0];
	}

	/**
	 * 根据开始和结束获取数组组成的字符串
	 * 
	 * @author sunson
	 */
	function _get_str_from_arr($arr, $begin, $end) {
		$ret = '';
		for($i = $begin; $i <= $end; $i++) {
			$ret .= $arr[$i];
		}
		return $ret;
	}

	/**
	 * 获取可用来检查的字符串数组
	 * 
	 * @author sunson
	 */
	function _get_arr_tobe_checked($i, $str_arr) {
		$ret = array();
		if($i < $this->MinLen) {
			return array(implode('', $str_arr));
		}
		$begin = $i > $this->MaxLen ? $i - $this->MaxLen : 0;
		for(; $begin <= $i - $this->MinLen; $begin ++) {
			$ret []= $this->_get_str_from_arr($str_arr, $begin, $i -1);
		}
		return $ret;
	}

	/**
	 * 真正用来匹配的逻辑
	 * 
	 * @author sunson
	 */
	function _do_check($check_arr) {
		if(!$this->MatchMaxFirst) {
			$check_arr = array_reverse($check_arr);
		}
		foreach ($check_arr as $key => $value) {
			if(isset($this->dic[$value])) {
				$tem_value = $this->_deal_str_to_arr($value);
				return array('key' => $value, 'val' => $this->dic[$value], 'length' => count($tem_value));
			}
		}
		return false;
	}

	/**
	 * 用RMM算法来查找关键字
	 * 
	 * @author sunson
	 */
	function split($str) {
		$str = $this->_deal_str_to_arr($str);
		$key_word = array();
		for($i = count($str); $i >0; ) {
			$check_arr = $this->_get_arr_tobe_checked($i, $str);
			$is_checked = $this->_do_check($check_arr);
			if($is_checked !== false) {
				$key_word []= $is_checked;
				$i -= $is_checked['length'];
			}else {
				$i --;
			}
		}
		return $key_word;
	}


}
?>