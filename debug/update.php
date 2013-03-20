<?php
$dir = "/var/www/weixin/debug/lib/update.sh";
$command = "expect {$dir}";
var_dump(system($command));

?>
