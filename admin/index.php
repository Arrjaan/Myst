<?php

require_once("../config.inc.php");
require_once("main.php");
require_once("tekstfuncties.php");

// database connectie \\
$db = db($db);

// pagina \\
if(isset($_GET['a_page'])) {
	$_SESSION['a_page'] = $_GET['a_page'];
}
if(!isset($_SESSION['a_page'])) {
	$_SESSION['a_page'] = "home";
}
$a_page = $_SESSION['a_page'];

// hash \\
if(!isset($_SESSION['hash'])) {
	$_SESSION['hash'] = "1";
}

// id \\
if(!isset($_SESSION['id'])) {
	$_SESSION['id'] = "empty";
}

// uitloggen \\
if($a_page == "admin_off") {

	//pagina opslaan\\
	$code = "101";
	
	save_log($_SESSION['id'], $code, $db);
	
	$_SESSION['hash'] = "1";
	$_SESSION['id'] = "empty";
	$_SESSION['a_page'] = "home";
	
}


// niet ingelogd \\
if ($_SESSION['hash'] == "1") {
	
	// Inloggen \\
	if(isset($_POST['log_on'])) {
		if($_POST['log_on'] == "Doorgaan") {

			$login = log_in($_POST['user'], $_POST['pass'], $db);

			if(($login[0] != false) AND (strlen($login[1]) == 32)) {

			//sessies aanmaken na succesvolle login\\
				$_SESSION['id'] = $login[0];
				$_SESSION['hash'] = $login[1];
				
				$code = "100";
				save_log($_SESSION['id'], $code, $db);
				
			}
			else {
				//er is een fout opgetreden\\
			}
		}
		else {
			//er is een fout opgetreden\\
		}
	exit;
	}
	else {
		// terug sturen als er niet wordt ingelogd en niet ingelogd is.\\
		header('HTTP/1.1 303 See Other');
		header('Location: ../');
	}
}


elseif (check_login($_SESSION['hash'], $_SESSION['id'], $db)) {
		
	//head
	a_head($a_page, $_SESSION['id']);
	
	// Begin scherm
	if($a_page == "home") {
		print("Welkom in het beheerderspaneel.<br /><br />Als dit uw eerste keer is verwijzen we u graag door naar onze <a href='https://github.com/Arrjaan/Myst/wiki'>wiki</a><br /><br />");
	
	$code = "200";
	}
	
	if($a_page == "log") {
		print("Hier wordt alles wat in dit panneel gebeurd opgeslagen in een logboek.<br /><br />");
		$query = $db->query("SELECT * FROM `log` ORDER BY `id` DESC");
		print("<table><tr><td>nummer</td><td width='5'></td><td>actie</td></tr>");
		while(list($id,$uid,$ip,$date,$code) = $query->fetch_row()) {
			$lil = $db->query("SELECT `username` FROM `users` WHERE `id` = " . $uid . "");
			$lil = mysqli_fetch_array($lil);
			print("<tr><td>#$id</td><td></td><td>" . $lil[0] . " heeft op $date vanaf $ip de volgende actie uitgevoerd: $code</td></tr>");
		}
		print("</table><br /><br />");
		
	$code = "300";
	}
	if($a_page == "leeg_log") {
		if($_SESSION['id'] == 1) {
			print("<br /><a href='leeg_log&legen=ja'>Leeg het logboek</a><br /><br /><a href='log'>Terug</a><br /><br />");
			if(isset($_GET['legen'])){
				if($_GET['legen'] == "ja") {
					$query = $db->query("TRUNCATE TABLE `log`");
					if($query) {
						print("Het logboek is geleegd.<br />");
					}
					else {
						print("Er is een fout opgetreden, het logboek is niet geleegd.<br />");
					}
					
				$code = "302";
				}
			}
			else {
			
			$code = "301";
			}
		}
		else {
			print("U bent niet gerechtigd om deze actie uit te voeren.<br /><br />");
			
		$code = "303";
		}
	}
		
	if($a_page == "beheerders") {
		$users = $db->query("SELECT `id`, `username` FROM `users`");
		
		if($_SESSION['id'] == 1) {
			print("Hier staan alle beheerders. U kunt beheerders toevoegen of verwijderen.<br /><br />");
			print("<table><tr><td>nummer</td><td></td><td>naam</td><td></td><td>wachtwoord</td><td></td><td>verwijderen</td></tr>");
			while(list($id,$username) = $users->fetch_row()) {
				print("<tr><td>#$id</td><td></td><td>$username</td><td></td><td>**********</td><td></td><td><a href='verwijder_beheerder&id=$id' alt='verwijderen?'>X</a></td></tr>");
			}
				print("</table><br /><br />");
		}
		else {
			print("Hier staan alle beheerders.<br /><br />");
			print("<table><tr><td>nummer</td><td></td><td>naam</td><td></td><td>wachtwoord</td></tr>");
			while(list($id,$username) = $users->fetch_row()) {
				print("<tr><td>#$id</td><td></td><td>$username</td><td></td><td>**********</td></tr>");
			}
				print("</table><br /><br />");
		}	
		
	$code = "400";
	}
	
	if($a_page == "nieuwe_beheerder") {
		if($_SESSION['id'] == 1) {
			if(1==2) {
				print("gebruiker toegevoegd<br /><br />");
				
			$code = "411";
			}
			else {
				print("Deze service is tijdelijk niet beschikbaar.<br />");
				//print("Voeg nieuwe gebruiker toe??<br /><br />");
				
			$code = "410";		
			}
		}
		else {
			print("U bent niet gerechtigd om deze actie uit te voeren.<br /><br />");
			
		$code = "412";
		}
	}
	
	if($a_page == "verwijder_beheerder") {
		if($_SESSION['id'] == 1) {
		
			if(1==2) {
				print("gebruiker verwijderd");
				// id tijdelijk veranderen van verwijderde gebruiker -- * is verwijderd door admin
				
			$code = "421";
			}
			else {
				print("Deze service is tijdelijk niet beschikbaar.<br />");
				//print("Verwijder gebruiker " . $_POST['nummer'] . "?<br /><br />");
				
			$code = "420";
			}
		}
		else {
			print("U bent niet gerechtigd om deze actie uit te voeren.<br /><br />");
			
		$code = "422";
		}
	}
			
	
	// server informatie
	if($a_page == "server") {
		print("De server is online.<br /><br />");
		
	$code = "201";
	}
	
	// website informatie
	if($a_page == "website") {
		print("De website is online maar onder constructie.<br /><br />Aantal bezoekers: Onbekend<br /><br />");
		
	$code = "202";
	}
	
		// Berichten scherm
	if($a_page == "berichten") {
		
		if(!isset($_GET['verborgen'])) {
		
			print("<br /><br />");
			$verborgen = "1";
			zien_berichten($verborgen, $db);
			print("<br /><br />");
			
		}
		
	$code = "500";
	}
	
	//bericht verwijderen
	if($a_page == "verwijder_bericht") {
	
		if(isset($_GET['nummer'])) {
			if(!isset($_GET['ja'])) {
				print("Weet u zeker dat u dit bericht wilt verwijderen?<br />");
				print("<a href='verwijder_bericht&ja=ja&nummer=" . $_GET['nummer'] . "'>Verwijderen</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='berichten'>Terug gaan</a>");
			
			$code = "501";
			}
			elseif($_GET['ja'] == 'ja') {
				$verwijder_bericht = verwijder_bericht($_GET['nummer'], $db);
				
				if($verwijder_bericht) {
					print("Bericht is verwijderd.<br />");

				$code = "61" . $_GET['nummer'];
				}
				else {
					print("Bericht kon niet worden verwijderd.<br />");
					
				$code = "502";
				}
			}
		}
		else {
		
			print("<br />Kies hier het bericht dat je wilt verwijderen.<br />");
		
			print("<br /><br />");
			$verborgen = "8";
			zien_berichten($verborgen, $db);
			//print("Geen bericht geselecteerd.");
			print("<br /><br />");
			
		$code = "501";
		}
	}
		
	
	// Berichten bewerken
	if($a_page == "bewerk_bericht") {
		
		if(!isset($_GET['nummer']) && !isset($_GET['verzonden'])) {
			
			print("<br />Kies het bericht dat je wilt bewerken.<br />");
			
			print("<br /><br />");
			$verborgen = "9";
			zien_berichten($verborgen, $db);
			//print("Geen bericht geselecteerd.");
			print("<br /><br />");
			
		$code = "510";
		}
		elseif(isset($_GET['nummer']) && !isset($_GET['verzonden'])) {
			
			$nummer = $_GET['nummer'];
			$bewerk_bericht = bewerk_bericht($nummer, $db);
			
			if($bewerk_bericht == "Bericht bestaat niet.") {
				print("Bericht bestaat niet.");
			}
			else {
				?>
				
				<html><head><script language="JavaScript" type="text/javascript" src="js/nieuwsboxtextedit.js"></script></head><body>
				Nieuw bericht maken
				<br /><br />
				
				<script language="JavaScript" type="text/javascript">
					window.onload = nieuw_bericht; 
				</script>
							
				<fieldset>
				<form name="" action="bewerk_bericht&verzonden=verzonden" method="post">
				<br /><br /><br />
				<p><input type="radio" name="verborgen" value="1" id="verborgen" <?php if($bewerk_bericht['verborgen'] == "1") { print("checked"); } ?> >&nbsp;<label for="verborgen">Verborgen</label>
				<input type="radio" name="verborgen" value="0" id="zichtbaar" <?php if($bewerk_bericht['verborgen'] == "0") { print("checked"); } ?> >&nbsp;<label for="zichtbaar">Zichtbaar</label>
				<p>Door:<br /><input type="text" name="van" value="<?php print($bewerk_bericht['van']); ?>" class="text-long"></p>
				<p>Titel:<br /><input type="text" name="titel" value="<?php print($bewerk_bericht['title']); ?>" class="text-long"></p>
				Bericht:<br /><br /><br />
				<div id="input"><br /></div>
				<textarea name="tekst"><?php print($bewerk_bericht['tekst']); ?></textarea><br /><br /><br /><br /><br /><br /><br /><br />
				<input type="hidden" name="nummer" value="<?php print("" . $bewerk_bericht['nummer'] . ""); ?>">
				<input type="submit" name="submit" value="Verzenden"><br />
				<input type="reset" name="reset" value="      Reset      ">
				</form>
				</fieldset>
				
				<?php
			}
			
		$code = "510";
		}
		elseif($_GET['verzonden'] == 'verzonden') {
			
			$tekst = $_POST['tekst'];
			$van = $_POST['van'];
			$titel = $_POST['titel'];
			$verborgen = $_POST['verborgen'];
			$nummer = $_POST['nummer'];
		
			$bewerk_bericht_versturen = bewerk_bericht_versturen($van, $titel, $tekst, $verborgen, $nummer, $db);
						
			if($bewerk_bericht_versturen) {
				print("Bericht is verzonden.<br />");
				// nieuw bericht opslaan in de log
			
			$code = "62" . $nummer;
			}
			else {
				print("Bericht kon niet worden verzonden.<br />");
				
			$code = "511";
			}
			
			
		}
		
	}
	
	// Nieuwe berichten scherm
	if($a_page == "nieuw_bericht") {
		if(!isset($_GET['verzonden'])) {
			?>
			
			<html><head><script language="JavaScript" type="text/javascript" src="js/nieuwsboxtextedit.js"></script></head><body>
			Nieuw bericht maken
			<br /><br />
			
			<script language="JavaScript" type="text/javascript">
				window.onload = nieuw_bericht; 
			</script>
						
			<fieldset>
			<form name="" action="nieuw_bericht&verzonden=verzonden" method="post">
			<p>Door:<br /><input type="text" name="van" value="Administrator" class="text-long"></p>
			<p>Titel:<br /><input type="text" name="titel" value="Titel" class="text-long"></p>
			Bericht:<br /><br /><br />
			<div id="input" height="50"><br /></div>
			<textarea name="tekst"></textarea><br /><br /><br /><br /><br /><br /><br /><br />
			<input type="submit" name="submit" value="Verzenden"><br />
			<input type="reset" name="reset" value="      Reset      ">
			</form>
			</fieldset>
				
			<?php
			
		$code = "520";		
		}
		elseif($_GET['verzonden'] == 'verzonden') {
			
			$tekst = $_POST['tekst'];
			$van = $_POST['van'];
			$titel = $_POST['titel'];
		
			$nieuw_bericht = nieuw_bericht($van, $titel, $tekst, $db);
						
			if($nieuw_bericht[0]) {
				print("Bericht is verzonden.<br />");

			$code = "60" . $nieuw_bericht[1];
			}
			else {
				print("Bericht kon niet worden verzonden.<br />");

			$code = "521";
			}
		}
	}
	
	a_bottom();
	
		//pagina opslaan \\
	save_log($_SESSION['id'], $code, $db);
	
}

// sessie 'admin_on' is niet 'admin_logged_on' of 'empy'
else {
	
	print("Onbekende fout.");
	
	// inlogfout verholpen \\
	$_SESSION['hash'] = "1";
	$_SESSION['id'] = "empty";
	$_SESSION['a_page'] = "home";
	
}

?>