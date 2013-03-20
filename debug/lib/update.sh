#!/usr/bin/expect -f

spawn su weixin
#spawn su 
expect "Password"
sleep 0.5
send "weixin@tapD\r"
#send "Akerwin1021\r"
expect "$"
sleep 0.5
send "cd /var/www/weixin\r"
expect "$"
send "/usr/local/git/bin/git pull master 2>&1\r"
expect "$"
sleep 2
exit
