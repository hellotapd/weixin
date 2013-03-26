<?php
//define your token
define("TOKEN", "hellotapd1357");
define("ISDEV",true);

//require file
require_once("safe.php");
require_once("message/message_factory.php");
require_once("log.php");
require_once("log/tapd_log.php");

if(ISDEV) {
	define("LOGDIR","F:\\www\\weixin\\log\\");
	define("BASE_PATH","http://localhost/new_weixin/");
} else {
	define("LOGDIR","/var/www/weixin/log/");
	define("BASE_PATH","http://weixin.ifxoxo.com/");
}

?>