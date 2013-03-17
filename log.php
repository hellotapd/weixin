<?php

class Log{
	static function access_log( $postStr ) {
		$dir = "/var/www/weixin/log/access.log";
		file_put_contents($dir, $postStr);
	}
}

?>