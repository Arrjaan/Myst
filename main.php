<?php

function error($errormsg, $errno = 0) {
	echo $errormsg;
}

function redirect($url) {
	if ( !headers_sent() ) {
		header("HTTP/1.1 302 found");
		header("Location: ".$url);
	}
	else error('<span style="font-family: 
		Tahoma; font-size: 11px;">Redirect : De HTML pagina is al verstuurd. Headers kunnen niet meer aangepast worden.</span>');
	die();
}

?>