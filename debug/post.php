<?php
require_once('post_message.php');
header("content-type:text/html;charset=utf-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>debug</title>
</head>
<body>
<form action="post.php" method="post">
输入内容<br />
<textarea name="content" cols="40" rows="10"></textarea>
<input type="submit" value="submit" />
</form>
<br><br>
<?php
if(!empty($_POST)) {
 $template = "<xml>
       <ToUserName><![CDATA[debug_system]]></ToUserName>
       <FromUserName><![CDATA[debug_user]]></FromUserName>
       <CreateTime>1348831860</CreateTime>
       <MsgType><![CDATA[text]]></MsgType>
       <Content><![CDATA[".$_POST['content']."]]></Content>
     </xml>";

echo 'input is:';
var_dump($_POST['content']);
echo '<br>';
$send_message = new SendMessage();
$ret = $send_message->send_message($template);
echo 'the return is :<br>';
var_dump((string)$ret->Content);
}
?>
</body>
</html>
