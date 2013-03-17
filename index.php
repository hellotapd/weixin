<?php
require_once("safe.php");
require_once("message_factory.php");
require_once("core.php");

if(Safe::vaild()) {
	$post_str = $GLOBALS["HTTP_RAW_POST_DATA"];
	// $post_str = "<xml>
 //       <ToUserName><![CDATA[toUser]]></ToUserName>
 //       <FromUserName><![CDATA[fromUser]]></FromUserName>
 //       <CreateTime>1348831860</CreateTime>
 //       <MsgType><![CDATA[text]]></MsgType>
 //       <Content><![CDATA[detail]]></Content>
 //     </xml>";
	$msgObj = MessageFactory::init($post_str);
	$respone_str  = $msgObj->get_msg();
	echo $respone_str;
} 



?>