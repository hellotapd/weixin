#!/usr/bin/expect
spawn su weixin
expect "Password"
sleep 0.5
send "weixin@tapD\r"
expect "$"
sleep 0.5
send "/usr/bin/sh /var/www/weixin/message/lib/update_git.sh\r"
exit