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
/* -----------------------------------------------

	* Screen Style Sheet

	* Name: Transdmin Light
	
	* Coded by: Perspectived
	  http://www.perspectived.com

----------------------------------------------- */

/* CSS reset by Eric Meyer */
@import url("reset.css");
@import url("layout.css");
/*@import url("jNice.css");*/
@import url("hack.css");
");
	if(extension_loaded('zlib')){
		ob_end_flush();
	} 
exit;
} 
else { ; }?>