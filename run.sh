echo "Restarting simple-tgbot..."

kill `cat 1.pid`

nohup php tgbot.php > /dev/null 2>&1 & echo $! > 1.pid



