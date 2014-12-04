<!doctype html>
<html>
<head>
   <meta charset="UTF-8">
   <link rel="shortcut icon" href="./.favicon.ico">
   <title>Web Server Folder</title>

   <link rel="stylesheet" href="./.style.css">
   <script src="./.sorttable.js"></script>
   
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" />
	<link rel="stylesheet" href="../../.js/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" />

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

	<!-- production -->
	<script type="text/javascript" src="../../.js/plupload.full.min.js"></script>
	<script type="text/javascript" src="../../.js/jquery.ui.plupload/jquery.ui.plupload.js"></script>

	<script type="text/javascript">

	function getCookie(w) {
		cName = "";
		pCOOKIES = new Array();
		pCOOKIES = document.cookie.split('; ');
		for(bb = 0; bb < pCOOKIES.length; bb++) {
			NmeVal  = new Array();
			NmeVal  = pCOOKIES[bb].split('=');
			if(NmeVal[0] == w){
				cName = unescape(NmeVal[1]);
			}
		}
		return cName;
	}

	function setCookie(name, value) {

		var now = new Date();
		var time = now.getTime();
		time += 3600;
		now.setTime(time);

		document.cookie = name + "=" + escape(value) + '; expires=' + now.toGMTString() + "; path=/";
	}


	function notify()
	{
		var uploaded = getCookie("uploaded");
		
		if (uploaded == "yes") 
		{
			setTimeout(showBanner, 500);
			setCookie("uploaded", "no")
		}
	}

	function showBanner()
	{
		var element = document.getElementById("banner");
		element.setAttribute("style","top: 0px;");

		setTimeout(hideBanner, 3000);
	}

	function hideBanner()
	{
		var element = document.getElementById("banner");
		element.setAttribute("style","top: -52px;");
	}

</script>

</head>

<body>

<div id="banner">
	<h1>Upload Completed</h1>
</div>

<script type="text/javascript">
	notify();
</script>

<div id="container">
	<h1>Web Server Folder</h1>

	<table class="sortable">
	    <thead>
		<tr>
			<th>Filename</th>
			<th>Type</th>
			<th>Size</th>
			<th>Date Modified</th>
		</tr>
	    </thead>
	    <tbody><?php

	// Adds pretty filesizes
	function pretty_filesize($file) {
		$size=filesize($file);
		if($size<1024){$size=$size." Bytes";}
		elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
		elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
		else{$size=round($size/1073741824, 1)." GB";}
		return $size;
	}

 	// Checks to see if veiwing hidden files is enabled
	if($_SERVER['QUERY_STRING']=="hidden")
	{$hide="";
	 $ahref="./";
	 $atext="Hide";}
	else
	{$hide=".";
	 $ahref="./?hidden";
	 $atext="Show";}

	 // Opens directory
	 $myDirectory=opendir(".");

	// Gets each entry
	while($entryName=readdir($myDirectory)) {
	   $dirArray[]=$entryName;
	}

	// Closes directory
	closedir($myDirectory);

	// Counts elements in array
	$indexCount=count($dirArray);

	// Sorts files
	sort($dirArray);

	// Loops through the array of files
	for($index=0; $index < $indexCount; $index++) {

	// Decides if hidden files should be displayed, based on query above.
	    if(substr("$dirArray[$index]", 0, 1)!=$hide) {

	// Resets Variables
		$favicon="";
		$class="file";

	// Gets File Names
		$name=$dirArray[$index];
		$namehref=$dirArray[$index];

	// Check if index.php file
		if($name=="index.php"){continue;}

	// Check if php.ini file
		if($name=="php.ini"){continue;}

	// Gets Date Modified
		date_default_timezone_set('America/Sao_Paulo');
		$modtime=date("M j Y g:i A", filemtime($dirArray[$index]));
		$timekey=date("YmdHis", filemtime($dirArray[$index]));


	// Separates directories, and performs operations on those directories
		if(is_dir($dirArray[$index]))
		{
				$extn="&lt;Directory&gt;";
				$size="&lt;Directory&gt;";
				$sizekey="0";
				$class="dir";

			// Gets favicon.ico, and displays it, only if it exists.
				if(file_exists("$namehref/favicon.ico"))
					{
						$favicon=" style='background-image:url($namehref/favicon.ico);'";
						$extn="&lt;Website&gt;";
					}

			// Cleans up . and .. directories
				if($name=="."){$name=". (Current Directory)"; $extn="&lt;System Dir&gt;"; $favicon=" style='background-image:url($namehref/.favicon.ico);'";}
				if($name==".."){$name=".. (Parent Directory)"; $extn="&lt;System Dir&gt;";}
		}

	// File-only operations
		else{
			// Gets file extension
			$extn=pathinfo($dirArray[$index], PATHINFO_EXTENSION);

			// Prettifies file type
			switch ($extn){
				case "png": $extn="PNG Image"; break;
				case "jpg": $extn="JPEG Image"; break;
				case "jpeg": $extn="JPEG Image"; break;
				case "svg": $extn="SVG Image"; break;
				case "gif": $extn="GIF Image"; break;
				case "ico": $extn="Windows Icon"; break;

				case "txt": $extn="Text File"; break;
				case "log": $extn="Log File"; break;
				case "htm": $extn="HTML File"; break;
				case "html": $extn="HTML File"; break;
				case "xhtml": $extn="HTML File"; break;
				case "shtml": $extn="HTML File"; break;
				case "php": $extn="PHP Script"; break;
				case "js": $extn="Javascript File"; break;
				case "css": $extn="Stylesheet"; break;

				case "pdf": $extn="PDF Document"; break;
				case "xls": $extn="Spreadsheet"; break;
				case "xlsx": $extn="Spreadsheet"; break;
				case "doc": $extn="Microsoft Word Document"; break;
				case "docx": $extn="Microsoft Word Document"; break;

				case "zip": $extn="ZIP Archive"; break;
				case "htaccess": $extn="Apache Config File"; break;
				case "exe": $extn="Windows Executable"; break;

				default: if($extn!=""){$extn=strtoupper($extn)." File";} else{$extn="Unknown";} break;
			}

			// Gets and cleans up file size
				$size=pretty_filesize($dirArray[$index]);
				$sizekey=filesize($dirArray[$index]);
		}

	// Output
	 echo("
		<tr class='$class'>
			<td><a href='./$namehref'$favicon class='name'>$name</a></td>
			<td><a href='./$namehref'>$extn</a></td>
			<td sorttable_customkey='$sizekey'><a href='./$namehref'>$size</a></td>
			<td sorttable_customkey='$timekey'><a href='./$namehref'>$modtime</a></td>
		</tr>");
	   }
	}
	?>

	    </tbody>
	</table>

	<h2>	
		<div>	
			<form id="form" method="post" action="../.dump.php">
				<div id="uploader">
					<p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
				</div>
				<br />
			</form>

		</div> 
	</h2>

</div>

<script type="text/javascript">
// Initialize the widget when the DOM is ready
$(function() {
	$("#uploader").plupload({
		// General settings
		runtimes : 'html5,flash,silverlight,html4',
		url : '../.upload.php',

		// User can upload no more then 20 files in one go (sets multiple_queues to false)
		max_file_count: 20,
		
		chunk_size: '20mb',
		
		filters : {
			// Maximum file size
			max_file_size : '2000mb',
			// Specify what files to browse for
			mime_types: [
				{title : "Documents files", extensions : "txt,rtf,pages,key,keynote,doc,docx,wps,odt,xls,xlsx,wks,ods,ppt,pptx,pps,ppsx,odp,pdf"},
				{title : "Image files", extensions : "bmp,svg,tif,png,gif,jpg,jpeg,ico,icns,psd,cdr"},
				{title : "Music files", extensions : "flac,aac,aif,iff,mid,mp3,m4a,mpa,ra,wav,wma,ogg"},
				{title : "Video files", extensions : "3g2,3gp,asf,asx,avi,flv,mov,m4v,mkv,mp4,mpg,mpeg,rm,swf,vob,wmv,fcp,ppj,mswmm,veg,wlmp,imovieproj"},
				{title : "Zip files", extensions : "tar,gz,7z,rar,zip,zipx,gzip,dmg"},
				{title : "Other files", extensions : "htm,html,fnt,fon,otf,ttf,srt,sub,ssa"}
			]
		},

		// Rename files by clicking on their titles
		rename: true,
		
		// Sort files
		sortable: true,

		// Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
		dragdrop: true,

		// Views to activate
		views: {
			list: true,
			thumbs: true, // Show thumbs
			active: 'thumbs'
		},

		// Flash settings
		flash_swf_url : '../../.js/Moxie.swf',

		// Silverlight settings
		silverlight_xap_url : '../../.js/Moxie.xap'
	});
});
</script>

</body>
</html>
