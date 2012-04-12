<?php
// database connectie \\
function db($db) {

	$db = new Mysqli($db['server'], $db['user'], $db['passw'], $db['db'], $db['port']);

	if ($db->connect_errno) {
		die('Connect Error: ' . $db->connect_errno);
		return false;
	}
	else return $db;

}

$db = db($db);


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

// login -checker \\
function check_login($hash,$id,$db) {
	
	$check = @$db->query("SELECT `hash` FROM `users` WHERE `id`=" . $id . " ");
	$check = @$check->fetch_assoc();
	
	if($check['hash'] == $hash) {
		$return = true;
	}
	else {
		$return = false;
	}

return $return;
}

// Logboek \\
function save_log($uid, $code, $db) {

	//$ip = getRealIpAddr();
	//$date = tijd();

	//$query = $db->query("INSERT INTO `log`(`uid`, `ip`, `date`, `code`) VALUES('$uid', '$ip', '$date', '$code')");
	
	//print(mysql_error());
}

// berichten zien
function zien_berichten($verborgen, $db) {
		
		$verborgen = "0";
		$i = "0";
		
		$print = "<table width='200'>";
		
		$query = $db->query("SELECT * FROM `nieuws` WHERE `verborgen` = " . $verborgen . " ORDER BY `nummer` DESC");
		while(list($nummer,$verborgen,$van,$datum,$titel,$bericht) = mysqli_fetch_row($query)) {
		
			$bericht = bb_codes($bericht);
			$i = $i + "1";
			$print = $print . "	
					<tr><td>Van:</td><td>$van</td></tr>
					<tr><td>Op:</td><td>$datum</td></tr>
					<tr><td>Titel:</td><td>$titel</td></tr>
					<tr><td>Bericht:</td><td height='10' style='overflow:hidden; height:10px;'>$bericht</td></tr>
					<tr><td colspan='2' height='20'><hr widht='100%'</td></tr>
					";
		}
		
		if($i == "0") {
			$print = $print . "<tr><td>Er zijn geen berichten.</td></tr>";
		}
		
		$print = $print . "</table>";
		
		return($print);

}

?>