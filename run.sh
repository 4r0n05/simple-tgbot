echo "Restarting simple-tgbot..."

if [ -f 1.pid ];
then
	kill `cat 1.pid`
fi

nohup php tgbot.php > /dev/null 2>&1 & echo $! > 1.pid



