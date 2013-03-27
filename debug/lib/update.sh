#!/usr/bin/expect -f

spawn su weixin
expect "Password"
sleep 0.5
send "weixin@tapD\r"
expect "$"
sleep 0.5
send "cd /var/www/weixin\r"
expect "$"
send "/usr/local/git/bin/git pull master 2>&1\r"
expect "$"
sleep 1
send "cp core_default.php core.php"
expect "$"
sleep 0.5
exit
