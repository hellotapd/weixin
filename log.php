<?php
require_once("core.php");

/**
 * log 文件
 */
class Log{
	static function access_log( $postStr ) {
		$dir = LOGDIR."access.log";
		file_put_contents($dir, $postStr,FILE_APPEND);
	}

	static function respone_log( $postStr ) {
		$dir = LOGDIR."respone.log";
		file_put_contents($dir, $postStr,FILE_APPEND);
	}
}

?>