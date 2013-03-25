<?php
//define your token
define("TOKEN", "hellotapd1357");
define("ISDEV",false);

//require file
require_once("safe.php");
require_once("message/message_factory.php");
require_once("log.php");
require_once("log/tapd_log.php");

if(ISDEV) {
	define("LOGDIR","F:\\www\\weixin\\log\\");
} else {
	define("LOGDIR","/var/www/weixin/log/");
}

?>