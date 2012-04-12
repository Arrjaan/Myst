<?php

// database connectie \\
function db($db) {

	$db = new Mysqli($db['server'], $db['user'], $db['passw'], $db['db'], $db['port']);

return $db;
}

// login functie \\
function log_in($user, $pass, $db) {

			$logon = $db->query("SELECT `id` FROM `users` WHERE `password`='" . md5($pass) . "' AND `username`='" . $user . "'");
			$logon = $logon->fetch_assoc();
			
			if(!isset($logon['id'])) {
				//gebruiker-wachtwoord combinatie bestaat niet\\
				$return = (array(false,1));
			}
			elseif((isset($logon['id']))) {
				//positieve ID terug\\
				$id = $logon['id'];
				unset($logon);
				$hash = random();
				
				//hash opslaan in database\\
				$save = @$db->query("UPDATE `users` SET `hash`='" . $hash . "'");
				if($save) {
					// goede login, opslaan\\
					$sort = 'login';
					$return = (array($id,$hash));
				}
				else {
					//databasefout\\
					unset($id);
					unset($hash);
					$hash = 1;
					$id = "empty";
					$return = (array(false,2));
				}
			}
			else {
				//onbekende fout\\
				$return = (array(false,3));
			}
	
	return $return;
}

// login -checker \\
function check_login($hash,$id,$db) {
	
	$check = $db->query("SELECT `hash` FROM `users` WHERE `id`=" . $id . " ");
	$check = mysqli_fetch_assoc($check);
	
	if($check['hash'] == $hash) {
		$return = true;
	}
	else {
		$return = false;
	}

return $return;
}

// random hash 32 \\
function random() {
	$salt = rand(9999,99999);
	$rand = rand(1000,9999);
	$rand = md5($rand);
	$rand = $rand . (time() * '3,14156' * rand(1,9));
	$rand = sha1($rand,33);
	$rand = md5($rand);
	$rand = $rand . $salt;
	$rand = str_split($rand,32);
	$random = $rand[0];
	
return $random;
}
	
// Echt ip-adres \\
function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


// dagen omrekenen \\
function ned_dag($dag) {
	for($i=1;$i<=7;$i++) {
		if($dag == $i) {
			$ned_dag = array('','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag','Zondag');
			$dag = $ned_dag[$i];
		}
	}
	return($dag);
}


// maanden omrekenen \\
function ned_maand($maand) {
	for($i=1;$i<=12;$i++) {
		if($maand == $i) {
			$ned_maand = array('','Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December');
			$maand = $ned_maand[$i];
		}
	}
	return($maand);
}


// datum en tijd \\
function tijd() {

	$dag = date("N");
	$dag = ned_dag($dag);
	$maand = date("n");
	$maand = ned_maand($maand);
	$datum = $dag . " " . date("j") . " " . $maand . " " . date("Y H:i:s");

	return($datum);
}

// bb-codes \\
function bb_codes($bericht) {

	$lijst_codes = array('[br]','[b]','[/b]','[u]','[/u]','[i]','[/i]','[url=','/]','[/url]');
	$lijst_html = array('<br />','<b>','</b>','<u>','</u>','<i>','</i>','<a href=\'','\' target=\'_blank\'>','</a>');
	$bericht = str_replace($lijst_codes, $lijst_html, $bericht);
	
	return($bericht);
}

// regelafbraak \\
function naar_br($tekst) {

	$replace = array("\r\n", "\r", "\n", "<", ">");
	$new = array("[br]", "[br]", "[br]", "&lt;", "&gt;");
	$tekst = str_replace($replace, $new, $tekst);

	return($tekst);
}

// Logboek \\
function save_log($uid, $code, $db) {

	$ip = getRealIpAddr();
	$date = tijd();

	$query = $db->query("INSERT INTO `log`(`uid`, `ip`, `date`, `code`) VALUES('$uid', '$ip', '$date', '$code')");

}

// berichten zien
function zien_berichten($verborgen, $db) {

	if($verborgen == "1") {
		
		$query = $db->query("SELECT * FROM `nieuws` ORDER BY `nummer` DESC");
		$i = "0";

		while(list($nummer,$verborgen,$van,$datum,$titel,$bericht) = mysqli_fetch_row($query)) {
			$i = $i + "1";
			if($verborgen == "1") {
				$verborgen = "Verborgen";
			}
			else {
				$verborgen = "Zichtbaar";
			}
			
			$bericht = bb_codes($bericht);
			
			print("	
					<table onClick=\"showHide('file_" . $nummer . "')\" style='margin-top: 5px; cursor: pointer;'>
					<tr><td class='datum'>$datum</td><td class='punten'>::</td><td class='titel'>$titel</td><td class='punten'>::</td></tr>
					</table>
					
					<div id='file_" . $nummer . "' style='background: #ddd; display: none; padding: 3px 5px 5px 5px; visibility: hidden;'>
					<a href='bewerk_bericht&nummer=$nummer'>Dit bericht bewerken.</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='verwijder_bericht&nummer=$nummer'>Dit bericht verwijderen.</a>
					<table class=\"nieuws\">
					<tr><td>Nummer:</td><td class='nieuws'>$nummer</td></tr>
					<tr><td>Verborgen:</td><td class='nieuws'><a href='berichten&nummer=$nummer' alt='verander'>$verborgen</a></td></tr>
					<tr><td>Van:</td><td class='nieuws'>$van</td></tr>
					<tr><td>Op:</td><td class='nieuws'>$datum</td></tr>
					<tr><td>Titel:</td><td class='nieuws'>$titel</td></tr>
					<tr><td>Bericht:</td><td class='nieuws'>$bericht</td></tr>
					</table>
					</div>
			");
		}
		
		if($i == "0") {
			print("<tr><td>Er zijn geen berichten.</td></tr>");
		}
		
	}
	elseif($verborgen == "0") {
		
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
	
	elseif($verborgen == "9") {
		
		$query = $db->query("SELECT * FROM `nieuws` ORDER BY `nummer` DESC");
		$i = "0";

		while(list($nummer,$verborgen,$van,$datum,$titel,$bericht) = mysqli_fetch_row($query)) {
			$i = $i + "1";
			
			print("	
					<table onClick=\"showHide('file_" . $nummer . "')\" style='margin-top: 5px; cursor: pointer;'>
					<tr><td class='nummer'>#$nummer</td><td class='datum'>$datum</td><td class='punten'>::</td><td class='titel'>$titel</td><td class='punten'>::</td></tr>
					</table>
					
					<div id='file_" . $nummer . "' style='background: #ddd; display: none; padding: 3px 5px 5px 5px; visibility: hidden;'>
					<a href='bewerk_bericht&nummer=$nummer'>Dit bericht bewerken.</a>
					</div>
			");
		}
		
		if($i == "0") {
			print("<tr><td>Er zijn geen berichten.</td></tr>");
		}
		
	}
	
	
	elseif($verborgen == "8") {
		
		$query = $db->query("SELECT * FROM `nieuws` ORDER BY `nummer` DESC");
		$i = "0";

		while(list($nummer,$verborgen,$van,$datum,$titel,$bericht) = mysqli_fetch_row($query)) {
			$i = $i + "1";
			
			print("	
					<table onClick=\"showHide('file_" . $nummer . "')\" style='margin-top: 5px; cursor: pointer;'>
					<tr><td class='nummer'>#$nummer</td><td class='datum'>$datum</td><td class='punten'>::</td><td class='titel'>$titel</td><td class='punten'>::</td></tr>
					</table>
					
					<div id='file_" . $nummer . "' style='background: #ddd; display: none; padding: 3px 5px 5px 5px; visibility: hidden;'>
					<a href='verwijder_bericht&nummer=$nummer'>Dit bericht verwijderen.</a>
					</div>
			");
		}
		
		if($i == "0") {
			print("<tr><td>Er zijn geen berichten.</td></tr>");
		}
		
	}
	

}

//bericht bewerken
function bewerk_bericht($nummer, $db) {

	$query = $db->query("SELECT MAX(`nummer`) FROM `nieuws`");
	$aantal = mysqli_fetch_array($query);

	if($nummer <= $aantal[0]) {

	$query = $db->query("SELECT * FROM `nieuws` WHERE `nummer`=" . $nummer . "");
	$query = mysqli_fetch_assoc($query);

	$query['tekst'] = str_replace("[br]", "\n", $query['tekst']);
	
	return($query);
	}
	else {
		$fout = "Bericht bestaat niet.";
		return($fout);
	}
}

//berwerkt bericht versturen
function bewerk_bericht_versturen($van, $titel, $tekst, $verborgen, $nummer, $db) {
	
	$tekst = naar_br($tekst);
	
	$query = $db->query("UPDATE `nieuws` SET `verborgen`=" . $verborgen . ", `van`='" . $van . "', `title`='" . $titel . "', `tekst`='" . $tekst . "'  WHERE `nummer`=" . $nummer . "");
		
	if($query) {
		$bewerk_bericht_versturen = true;
		//print("Uw bericht is succesvol toegevoegd aan de database!<br />");
	}
	else {
		$bewerk_bericht_versturen = false;
		//print("Uw bericht kon niet worden toegevoegd aan de database.<br />Probeer het later nog eens.<br />");
	}

	return($bewerk_bericht_versturen);
}


//nieuw bericht toevoegen
function nieuw_bericht($van, $titel, $tekst, $db) {

	$datum = tijd();
	
	$query = $db->query("SELECT MAX(`nummer`) FROM `nieuws`");
	$nummer = mysqli_fetch_array($query);
	$nummertje = $nummer[0] + 1;
	$verborgen = "1"; //standaard verborgen
	
	$tekst = naar_br($tekst);
	
	$query = $db->query("INSERT INTO `nieuws`(`nummer`, `verborgen`, `van`, `datum`, `title`, `tekst`) VALUES (" . $nummertje . ", " . $verborgen . ", '" . $van . "', '" . $datum . "', '" . $titel . "', '" . $tekst . "')");
	
	if($query) {
		$nieuw_bericht = array(true, $nummertje);
		//print("Uw bericht is succesvol toegevoegd aan de database!<br />");
	}
	else {
		$nieuw_bericht = array(false, $nummertje);
		//print("Uw bericht kon niet worden toegevoegd aan de database.<br />Probeer het later nog eens.<br />");
	}

	return($nieuw_bericht);
}

//bericht verwijderden
function verwijder_bericht($nummer, $db) {

	$query = $db->query("DELETE FROM `nieuws` WHERE `nummer`=" . $nummer . "");
	
	if($query) {
		$verwijder_bericht = true;
		//print("Het bericht is succesvol verwijderd uit de database.<br />");
	}
	else {
		$verwijder_bericht = false;
		//print("Het bericht kon niet uit de database worden verwijderd.<br />");	
	}

	return($verwijder_bericht);
}

// verborgen naar zichtbaar en andersom
function verborgen_bericht($nummer, $db) {

	$query = $db->query("SELECT `verborgen` FROM `nieuws` WHERE `nummer`=" . $nummer . "");
	$verborgen = mysqli_fetch_row($query);
	
	if($verborgen['0'] == "0") { // zichtbaar naar verborgen
		$verborgen['0'] = "1";
	}
	elseif($verborgen['0'] == "1") { // verborgen naar zichtbaar
		$verborgen['0'] = "0";
	}
	
	$verborgen = $verborgen['0'];
	
	$query = $db->query("UPDATE `nieuws` SET `verborgen`=" . $verborgen . " WHERE `nummer`=" . $nummer . "");
	if($query) {
		$verborgen_bericht = true;
		//print("Het bericht is succesvol geupdate in de database.<br />");
	}
	else {
		$verborgen_bericht = false;
		//print("Het bericht kon niet worden geupdate in de database.<br />");
		}

	return($verborgen_bericht);
}

// head \\
function a_head($a_page, $id) {

//begin
print('
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MystCMS</title>


<link href="transdmin.css" rel="stylesheet" type="text/css" media="screen" />

<!-- JavaScripts-->
<script type="text/javascript" src="js/functions.js"></script>
<!-- <script type="text/javascript" src="style/js/jquery.js"></script> -->
<!-- <script type="text/javascript" src="style/js/jNice.js"></script> -->
</head>

<body>
	<div id="wrapper">
    	<!-- h1 tag stays for the logo, you can use the a tag for linking the index page -->
    	<h1><a href="#"><span>Transdmin Light</span></a></h1>
        <!-- You can name the links with lowercase, they will be transformed to uppercase by CSS, we prefered to name them with uppercase to have the same effect with disabled stylesheet -->
        <ul id="mainNav">
');

//mainnav
	//home
	if($a_page == "home" OR $a_page == "server" OR $a_page == "website") {
		print('<li><a href="home" class="active">Home</a></li>');
	}
	else {
		print('<li><a href="home">Home</a></li>');
	}
	//berichten
	if($a_page == "berichten" OR $a_page == "nieuw_bericht" OR $a_page == "bewerk_bericht" OR $a_page == "verwijder_bericht") {
		print('<li><a href="berichten" class="active">Berichten</a></li>');
	}
	else {
		print('<li><a href="berichten">Berichten</a></li>');
	}
	//beheerders
	if($a_page == "beheerders" OR $a_page == "nieuwe_beheerder") {
		print('<li><a href="beheerders" class="active">Beheerders</a></li>');
	}
	else {
		print('<li><a href="beheerders">Beheerders</a></li>');
	}
	//logboek
	if($a_page == "log" OR $a_page == "leeg_log") {
		print('<li><a href="log" class="active">Logboek</a></li>');
	}
	else {
		print('<li><a href="log">Logboek</a></li>');
	}
	//logout
	print('
	        	<li class="logout"><a href="unset">LOGOUT</a></li>
	        </ul>
	        <!-- // #end mainNav -->
	');
// end mainnav

// container
	print('
	        <div id="containerHolder">
				<div id="container">
	');
	//sidebar
	//home
	if($a_page == "home" OR $a_page == "server" OR $a_page == "website") {
	print('        		
		<div id="sidebar">
			<ul class="sideNav">
				<li><a href="home"'); if($a_page == "home") { print('class="active"'); } else { ; } print('>Home</a></li>
				<li><a href="server"'); if($a_page == "server") { print('class="active"'); } else { ; } print('>Serverstatus</a></li>
				<li><a href="website"'); if($a_page == "website") { print('class="active"'); } else { ; } print('>Websitestatus</a></li>
			</ul>
			<!-- // .sideNav -->
		</div>    
		<!-- // #sidebar -->
		
		<!-- h2 stays for breadcrumbs -->
		<h2><a href="home"'); if($a_page == "home") { print('class="active">Home</a>'); } 
		else { 
			print('>Home</a> &raquo; <a href="?a_page=' . $a_page . '" class="active">'); 
			if($a_page == "server") { print('Serverstatus'); } 
			elseif($a_page == "website") { print('Websitestatus'); } 
			print('</a></h2>'); 
		} 
			print('</a></h2>'); 
	}	
	//logboek
	elseif($a_page == "log" or $a_page == "leeg_log") {
	print('        		
		<div id="sidebar">
			<ul class="sideNav">
				<li><a href="log"'); if($a_page == "log") { print('class="active"'); } else { ; } print('>Logboek</a></li>
	');
		if($id == "1") {
	print('<li><a href="leeg_log"'); if($a_page == "leeg_log") { print('class="active"'); } else { ; } print('>Logboek legen</a></li>');
		}
	print('
			</ul>
			<!-- // .sideNav -->
		</div>    
		<!-- // #sidebar -->
		
		<!-- h2 stays for breadcrumbs -->
		<h2><a href="log"'); if($a_page == "log") { print('class="active">Logboek</a>'); } 
		else { 
			print('>Logboek</a> &raquo; <a href="' . $a_page . '" class="active">'); 
			if($a_page == "leeg_log") { print('Logboek legen'); } 
			print('</a></h2>'); 
		} 
			print('</a></h2>'); 
	}		
	//beheerders
	elseif($a_page == "beheerders" OR $a_page == "nieuwe_beheerder") {
	print('        		
		<div id="sidebar">
			<ul class="sideNav">
				<li><a href="beheerders"'); if($a_page == "beheerders") { print('class="active"'); } else { ; } print('>Beheerders</a></li>
				<li><a href="nieuwe_beheerder"'); if($a_page == "nieuwe_beheerder") { print('class="active"'); } else { ; } print('>Beheerder toevoegen</a></li>
			</ul>
			<!-- // .sideNav -->
		</div>    
		<!-- // #sidebar -->
		
		<!-- h2 stays for breadcrumbs -->
		<h2><a href="beheerders"'); if($a_page == "beheerders") { print('class="active">Beheerders</a>'); } 
		else { 
			print('>Beheerders</a> &raquo; <a href="' . $a_page . '" class="active">'); 
			if($a_page == "nieuwe_beheerder") { print('Beheerder toevoegen'); } 
		} 
			print('</a></h2>'); 
	}			
	//berichten
	if($a_page == "berichten" OR $a_page == "nieuw_bericht" OR $a_page == "bewerk_bericht" OR $a_page == "verwijder_bericht") {
	print('        		
		<div id="sidebar">
			<ul class="sideNav">
				<li><a href="berichten"'); if($a_page == "berichten") { print('class="active"'); } else { ; } print('>Berichten</a></li>
				<li><a href="nieuw_bericht"'); if($a_page == "nieuw_bericht") { print('class="active"'); } else { ; } print('>Bericht toevoegen</a></li>
				<li><a href="bewerk_bericht"'); if($a_page == "bewerk_bericht") { print('class="active"'); } else { ; } print('>Bericht bewerken</a></li>
				<li><a href="verwijder_bericht"'); if($a_page == "verwijder_bericht") { print('class="active"'); } else { ; } print('>Bericht verwijderen</a></li>
			</ul>
			<!-- // .sideNav -->
		</div>    
		<!-- // #sidebar -->
		
		<!-- h2 stays for breadcrumbs -->
		<h2><a href="berichten"'); if($a_page == "berichten") { print('class="active">Berichten</a>'); } 
		else { 
			print('>Berichten</a> &raquo; <a href="' . $a_page . '" class="active">'); 
			if($a_page == "nieuw_bericht") { print('Bericht toevoegen'); } 
			elseif($a_page == "bewerk_bericht") { print('Bericht bewerken'); } 
			elseif($a_page == "verwijder_bericht") { print('Bericht verwijderen'); } 
		} 
			print('</a></h2>'); 
	}	
print('<br /><br /><div id="main">');
}

// bottom \\
function a_bottom() {
print(' 			</div>
					<!-- // #main -->
				<div class="clear"></div>
			</div>
			<!-- // #container -->
		</div>	
		<!-- // #containerHolder -->
	</div>
	<!-- // #wrapper -->
</body>
</html>
');
}

?>