echo '<?xml version="1.0"?><items>'

QUERY="$1"
VALID="yes"
CURRENT_PORT=`cat ~/Library/Application\ Support/Alfred\ 2/Workflow\ Data/fmanoeli.webserver/ServerFolder/.port`

if [ "$QUERY" = "" ] ; then
	QUERY="'...'"
	VALID="no"
else
	re='^[0-9]+$'
	if ! [[ $QUERY =~ $re ]] ; then
	   QUERY="Not a number"
		VALID="no"
	fi

	if [ $QUERY -gt 65535 ] ; then
		QUERY="Number not valid"
		VALID="no"
	fi
fi

echo '<item arg="'$QUERY'" valid="'$VALID'">
	<title>Set Port to: '$QUERY'</title>
	<subtitle>Current Port: '$CURRENT_PORT'</subtitle>
	<icon>icon.png</icon>
	</item>'

echo '</items>'