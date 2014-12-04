#!/usr/bin/php
<?php

require_once('Support Files/class.html2text.inc');

// !get file contents...

$input = "";

$fp = fopen("php://stdin", "r");
while ( $line = fgets($fp, 1024) )
	$input .= $line;

$h2t =& new html2text($input);


$content = $h2t->get_text();

$summary = $content;

fclose($fp);

// !eliminate links...

$content = preg_replace('/Links:\n------(.*)/s', '', $content);

// !trim whitespace...

$content = trim($content);

// !remove link references...

$content = preg_replace('/\[.*?\]/', '', $content);

// !get words and chars...

$words = (str_word_count($content, 0));

$chars = strlen($content);

// !get filename...

$path = explode("/",$_ENV['CODA_FILEPATH']);

$path = array_reverse($path);


?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Document Statistics</title>

<style>

* {
	padding: 0;
	margin: 0;
}

body {
	padding: 25px;
	font: 11px/18px "Lucida Grande", Lucida, Verdana, sans-serif;
	text-shadow: 0 1px 0 #fff;
	background: url('data:image/gif;base64,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') fixed;
}

a:link, a:visited {
	color: #444;
	text-decoration: none;
}

a:hover, a:active {
	color: #f00;
}

.content {
	-webkit-border-radius: 6px;
	-webkit-box-shadow: 0 2px 5px rgba(0,0,0,.25);
}

h1 {
	border: 1px solid #aaa;
	padding: 5px 0px;
	-webkit-border-radius: 6px 6px 0 0;
	background-image: -webkit-linear-gradient(bottom, #cecece 0%, #fefefe 100%);
	font-size: 11px;
	text-align: center;
	white-space: pre;
	font-weight: bold;
}

h1 span {
	color: #0080ff;
}

.stats {
	border-right: 1px solid #aaa;
	border-bottom: 1px solid #aaa;
	border-left: 1px solid #aaa;
	-webkit-border-radius: 0 0 6px 6px;
	padding: 20px;
	font-size: 12px;
	line-height: 18px;
	background: #fff;
}

.credits {
	margin: 15px;
	text-align: right;
	font-size: 10px;
	
}

table {
	width: 100%;
}

td {
	padding-bottom: 10px;
}

td:first-child {
	width: 150px;
	font-weight: bold;
	text-align: right;
	vertical-align: top;
	padding-right: 10px;
}

tr:last-child td:first-child {
	padding-top: 18px;
}

.value {
	color: #fff;
	font-weight: bold;
	background-color: #a5abc6;
	padding-right: 5px;
	padding-left: 5px;
	-webkit-border-radius: 8px;
	text-shadow: none;
	-webkit-box-shadow: inset 0 2px 2px rgba(0,0,0,.2);
}

pre {
	font: 13px "Panic Sans", "Courier New", Courier, mono;
	background-color: #fcfcfc;
	padding: 20px;
	-webkit-border-radius: 10px;
	-webkit-box-shadow: inset 0 0 15px rgba(0,0,0,.25);
	white-space: pre-wrap;
}

</style>

</head>

<body>
	
	<div class="content">
	
		<h1>Document Statistics for: <span><?php echo $path[0]; ?></span></h1>
			
		<div class="stats">	
			
			<table>
				<tr>
					<td>Words Count:</td>
					<td><span class="value"><?php echo $words; ?></span></td>
				</tr>
				<tr>
					<td>Character Count:</td>
					<td><span class="value"><?php echo $chars;?></span></td>
				</tr>
<?php
			
if(!empty($h2t->_link_list)) {

	$links = explode(' ', $h2t->_link_list);
	
	$links = array_reverse($links);
	
	$pattern = '/\[.*?\]/';
	
	preg_match($pattern, $links[1], $link_total);
	
	$result = trim($link_total[0], '[');
	$result = trim($result, ']');
	
	echo '<tr>
			<td>Link Count:</td>
			<td><span class="value">'.$result.'</value></td>
		</tr>';

}

?>
				<tr>
					<td>Document Summary:</td>
					<td><pre><?php echo $summary; ?></pre></td>
				</tr>
			</table>
		
		</div>
	
	</div>
	
	<p class="credits"><a href="http://www.midwinter-dg.com/downloads_coda-plugin_document-summary.html">Document Statistics v1.0</a> Coda2 Plug-in © 2012 <a href="http://www.midwinter-dg.com/">midwinter-dg.com</a></p>
	
</body>
</html>