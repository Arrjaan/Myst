<?PHP
//sessies starten\\
session_start();


// database connectie \\
function db($db) {

	global $con;
	$con = new mysqli($db['server'], $db['user'], $db['passw'], $db['db']);
	unset($db);

	if ($con->connect_errno) {
		die('Connect Error: ' . $mysqli->connect_errno);
	}

}

function error($errormsg, $errno = 0) {
	echo $errormsg;
}

// direct doorsturen \\
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