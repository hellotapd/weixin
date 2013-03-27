<?php
function debug($var = false) {
		if (DEBUG) {
			print "\n<pre  style=\"text-align:left\">\n";
			$calledFrom = debug_backtrace();
			print "\n\r";
            echo '<strong>' . substr(str_replace(ROOT, '', $calledFrom[0]['file']), 0) . '</strong>';
            echo ' (line <strong>' . $calledFrom[0]['line'] . '</strong>)';
            print "\n";
			ob_start();
			print_r($var);
			$var = ob_get_clean();
			print "{$var}\n</pre>\n";
		}
	}

/**
 * 自动load message的类
 * @param string $message_name : 类名 如:TextDefault
 * @example : loadMessage("TextDefault")
 * @version 1.0
 * @author kerwin
 */
function loadMessage($message_name) {
	if(!class_exists($message_name)) {
		$ret = getClassDir($message_name);
		$dir = $ret['dir'];
		$file_name = $ret['file_name'];
		$class_dir = ROOT .DS. "message". DS . $dir . DS. $file_name;
		if( file_exists($class_dir)) {
			require_once($class_dir);
		} else {
			// 需要记录log

		}
	}
}

/**
 * 根据class_name 获取 该文件的位置  text_default
 * @param string $class_name  :类名 大写 如： TextDefault
 * @return array    获取的文件名和文件目录
 * @example : getClassDir("TextDefault") = array('dir'=>'text','file_name'=>'text_default.php')
 * @version 1.0
 * @author kerwin
 *
 */
function getClassDir( $class_name ){
	$dir = "";
	$file_name = "";
	$pattern = '/^([A-Z][a-z]+)(\w+)$/'; 
	if( preg_match($pattern, $class_name, $math)) {
		$dir = strtolower($math[1]);
		$file_name = $dir."_".strtolower($math[2]).".php";
	} else {
		// 需要记录log
	}
	return compact("dir", "file_name");
}

?>