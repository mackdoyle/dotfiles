#!/usr/bin/php
<?php

//calculate value of string...

function calculate_value($value) {

	eval("\$result = $value;");
	
	return $result; 

} 

//get selection and calculate...

$fp = fopen('php://stdin', 'r');

while ( $line = fgets($fp, 4096) )

	print calculate_value($line); 

fclose($fp);

?>