<?php 
session_start();

if($_SESSION['include_css'] != "include") { exit; } 
elseif($_SESSION['include_css'] == "include") { 
	$_SESSION['include_css'] = "done";
	if(extension_loaded('zlib')){
		ob_start('ob_gzhandler');
	} 
	header("Content-type: text/css"); 
print("
body {
	text-align: center;
	margin-top: 100px;
	background-position: left bottom;
	background-attachment: fixed;
	background-repeat: no-repeat;
	background-color: white;
}

img.submit {
	width: 200px;
	height: 20px;
}

.submit {
	align: center;
	width: 200px;
}

.blok {
	background-image: url('img/login_back.png');
	background-repeat: no-repeat;
	background-position: left top;
	margin: auto;
	width: 400px;
	height: 500px;
	padding: 30px 30px 30px 30px;
	font-family: \"Trebuchet MS\", Helvetica, sans-serif;
}

.blok_key {
	background-image: url('img/key.png');
	background-repeat: no-repeat;
	background-position: left top;
	height: 94px;
	width: 340px;
	text-align: right;
}

.blok_tekst {
	width: 340px;
	height: 100px;
	text-align: left
}

.blok_inloggen {	
	margin: 0px 69px 0px 69px;
	width: 202px;
	height: 164px;
	text-align: left;
	padding: 0px 1px 0px 1px;
}

.blok_gebruiker {
	background-image: url('img/user.png');
	background-position: 3px center;
	background-repeat: no-repeat;
	padding: 3px 3px 3px 22px;
	width: 200px;
	height: 26px;
	font-family: \"Arial\",Verdana,Sans-serif;
	font-size: 12px;
}

.blok_wachtwoord {
	background-image: url('img/keys.png');
	background-position: 3px center;
	background-repeat: no-repeat;
	padding: 3px 3px 3px 22px;
	width: 200px;
	height: 26px;
	font-family: \"Arial\",Verdana,Sans-serif;
	font-size: 14px;
}
");
	if(extension_loaded('zlib')){
		ob_end_flush();
	} 
exit;
} 
else { ; }?>