echo '<?xml version="1.0"?><items>'

PHP=`ps -ax | grep "php"`
GREP=`echo $PHP | grep "php -S"`

if [[ ! "$PHP" = "" && ! "$GREP" = "" ]]; then

	echo '<item arg="stop" valid="yes">
		<title>Stop Server</title>
		<icon>icon-stop.png</icon>
		</item>'
		
	echo '<item arg="" valid="no">
		<title>Server is Running</title>
		<icon>icon-info.png</icon>
		</item>'
	
else
	
	echo '<item arg="start" valid="yes">
			<title>Start Server</title>
			<icon>icon-start.png</icon>
			</item>'

fi

echo '</items>'