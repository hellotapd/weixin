<?php
//define your token
define("TOKEN", "hellotapd1357");
define("ISDEV",true);
define("DEBUG",1);


if(ISDEV) {
	define("BASE_PATH","http://localhost/new_weixin/");
} else {
	define("BASE_PATH","http://weixin.ifxoxo.com/");
}

/**
 * 文件分隔符
 * @author ruirayli
 */
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

/**
 * 根目录路径
 * @author ruirayli
 */
if (!defined('ROOT')) {
	define('ROOT', dirname(__FILE__));
}

/**
 * 日志级别:
 * 级别：info, 用于记录所有的显示信息
 * 级别：debug, 用于记录所有的调试信息 
 * 级别：warn, 用于记录所有的非正常预期结果，定位错误 
 * 级别：error, 用于记录所有的异常情况
 * @author ruirayli
 */
define("LOG_LEVEL", 0);

/**
 * 日志文件路径
 * @author ruirayli
 */
define("LOG_PATH", ROOT . DS . 'log' . DS . 'tapd.log');

/**
 * 日志文件大小（超过大小后，归档）
 * @author ruirayli
 */
define("LOG_FILE_SIZE_LIMITED", 1099511627776);



//require file
require_once("safe.php");
require_once("message/message_factory.php");
require_once("message/pic_message.php");
require_once("message/text_message.php");
require_once("log.php");
require_once("log/tapd_log.php");
require_once("basics.php");
?>