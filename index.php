<?php
require_once("safe.php");
require_once("message_factory.php");
require_once("core.php");

// if(Safe::vaild()) {
	$template = "<xml>
       <ToUserName><![CDATA[toUser]]></ToUserName>
       <FromUserName><![CDATA[fromUser]]></FromUserName>
       <CreateTime>1348831860</CreateTime>
       <MsgType><![CDATA[text]]></MsgType>
       <Content><![CDATA[detail]]></Content>
     </xml>";
	$post_str = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ? $GLOBALS["HTTP_RAW_POST_DATA"] :$template;
	
	$msgObj = MessageFactory::init($post_str);
	$respone_str  = $msgObj->get_msg();
	echo $respone_str;
// } 



?>