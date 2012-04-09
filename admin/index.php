<?php
require_once("../config.inc.php");
require_once("main.php");
require_once("nieuwsfuncties.php");
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
	$_SESSION['hash'] = "1";
	$_SESSION['id'] = "empty";
	$_SESSION['a_page'] = "home";
	//pagina opslaan
	//$sort = 'logout';
	//save_log($sort,$a_page); <--- Waar staat die functie!? Hij geeft 'empty' terug.. Hij moet niks returnen als dat kan.
}


// niet ingelogd \\
if ($_SESSION['hash'] == "1") {
	
	// Inloggen \\
	if(isset($_POST['log_on'])) {
		if($_POST['log_on'] == "Doorgaan") {

			$login = log_in($_POST['user'], $_POST['pass'], $db);

			if(($login[0] != false) AND (strlen($login[1]) == 32)) {
				//save_log();
				//sessies aanmaken na succesvolle login\\
				$_SESSION['id'] = $login[0];
				$_SESSION['hash'] = $login[1];
				
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
	a_head($a_page);
	
	// Begin scherm
	if($a_page == "home") {
		$code = "0001";
		print("Welkom in het beheerderspaneel.<br /><br />Als dit uw eerste keer is verwijzen we u graag door naar onze <a href='https://github.com/Arrjaan/Myst/wiki'>wiki</a><br /><br />");
	}
	
	if($a_page == "log") {
		print("Hier wordt alles wat in dit panneel gebeurd opgeslagen in een logboek.<br /><br />");
		$query = mysql_query("SELECT * FROM admin ORDER BY nummer DESC");
		print("<table><tr><td>nummer</td><td></td><td>actie</td></tr>");
		while(list($nummer,$regel) = mysql_fetch_row($query)) {
			print("<tr><td>#$nummer</td><td></td><td>$regel</td></tr>");
		}
		print("</table><br /><br />");
	}
	if($a_page == "leeg_log") {
		if($_SESSION['id'] == 1) {
			print("Leeg het logboek?<br /><br />");
		}
		else {
			print("U bent niet gerechtigd om deze actie uit te voeren.<br /><br />");
		}
	}
		
	if($a_page == "beheerders") {
		$query = mysql_query("SELECT nummer,naam FROM administrator");
		
		if($_SESSION['id'] == 1) {
			print("Hier staan alle beheerders. U kunt beheerders toevoegen of verwijderen.<br /><br />");
			print("<table><tr><td>nummer</td><td></td><td>naam</td><td></td><td>wachtwoord</td><td></td><td>verwijderen</td></tr>");
			while(list($nummer,$naam) = mysql_fetch_row($query)) {
				print("<tr><td>#$nummer</td><td></td><td>$naam</td><td></td><td>**********</td><td></td><td><a href='?a_page=verwijder_beheerder&nummer=$nummer' alt='verwijderen?'>X</a></td></tr>");
			}
				print("</table><br /><br />");
		}
		else {
			print("Hier staan alle beheerders.<br /><br />");
			print("<table><tr><td>nummer</td><td></td><td>naam</td><td></td><td>wachtwoord</td></tr>");
			while(list($nummer,$naam) = mysql_fetch_row($query)) {
				print("<tr><td>#$nummer</td><td></td><td>$naam</td><td></td><td>**********</td></tr>");
			}
				print("</table><br /><br />");
		}	
	}
	
	if($a_page == "nieuwe_beheerder") {
		if($_SESSION['id'] == 1) {
			print("Voeg nieuwe gebruiker toe??<br /><br />");
		}
		else {
			print("U bent niet gerechtigd om deze actie uit te voeren.<br /><br />");
		}	
	}
	
	if($a_page == "verwijder_beheerder") {
		if($_SESSION['id'] == 1) {
			print("Verwijder gebruiker " . $_POST['nummer'] . "?<br /><br />");
		}
		else {
			print("U bent niet gerechtigd om deze actie uit te voeren.<br /><br />");
		}
	}
			
	
	// server informatie
	if($a_page == "server") {
		print("De server is online.<br /><br />");
	}
	
	// website informatie
	if($a_page == "website") {
		print("De website is online maar onder constructie.<br /><br />Aantal bezoekers: Onbekend<br /><br />");
	}
		// Berichten scherm
	if($a_page == "berichten") {
		
		if(!isset($_GET['verborgen'])) {
		
			print("<br /><br />");
			$verborgen = "1";
			zien_berichten($verborgen);
			print("<br /><br />");
			
		}
	}
	
	//bericht verwijderen
	if($a_page == "verwijder_bericht") {
	
		if(isset($_GET['nummer'])) {
			if(!isset($_GET['ja'])) {
				print("Weet u zeker dat u dit bericht wilt verwijderen?<br />");
				print("<a href='?a_page=verwijder_bericht&ja=ja&nummer=" . $_GET['nummer'] . "'>Verwijderen</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='?a_page=berichten'>Terug gaan</a>");
			}
			elseif($_GET['ja'] == 'ja') {
				$verwijder_bericht = verwijder_bericht($_GET['nummer']);
				
				if($verwijder_bericht) {
					print("Bericht is verwijderd.<br />");
					// nieuw bericht opslaan in de log
					$sort = 'verwijder_bericht';
					save_log($sort,$a_page);
				}
				else {
					print("Bericht kon niet worden verwijderd.<br />");
					// nieuw bericht opslaan in de log
					$sort = 'verwijder_bericht_fail';
					save_log($sort,$a_page);
				}
			}
		}
		else {
		
			print("<br />Kies hier het bericht dat je wilt verwijderen.<br />");
		
			print("<br /><br />");
			$verborgen = "8";
			zien_berichten($verborgen);
			//print("Geen bericht geselecteerd.");
			print("<br /><br />");
			
		}
	}
		
	
	// Berichten bewerken
	if($a_page == "bewerk_bericht") {
		
		if(!isset($_GET['nummer']) && !isset($_GET['verzonden'])) {
			
			print("<br />Kies het bericht dat je wilt bewerken.<br />");
			
			print("<br /><br />");
			$verborgen = "9";
			zien_berichten($verborgen);
			//print("Geen bericht geselecteerd.");
			print("<br /><br />");
			
		}
		elseif(isset($_GET['nummer']) && !isset($_GET['verzonden'])) {
			
			$nummer = $_GET['nummer'];
			$bewerk_bericht = bewerk_bericht($nummer);
			
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
				<form name="" action="?a_page=bewerk_bericht&verzonden=verzonden" method="post">
				<p>Verborgen:<br />
				<input type="radio" name="verborgen" value="1" id="verborgen" <?php if($bewerk_bericht['verborgen'] == "1") { print("checked"); } ?> ><label for="verborgen">Verborgen</label>
				<input type="radio" name="verborgen" value="0" id="zichtbaar" <?php if($bewerk_bericht['verborgen'] == "0") { print("checked"); } ?> ><label for="zichtbaar">Zichtbaar</label>
				<p>Door:<br /><input type="text" name="van" value="<?php print($bewerk_bericht['van']); ?>" class="text-long"></p>
				<p>Titel:<br /><input type="text" name="titel" value="<?php print($bewerk_bericht['title']); ?>" class="text-long"></p>
				<p>Bericht:
				<div id="input"></div>
				<textarea name="tekst"><?php print($bewerk_bericht['tekst']); ?></textarea></p><br />
				<input type="hidden" name="nummer" value="<?php print("" . $bewerk_bericht['nummer'] . ""); ?>">
				<input type="submit" name="submit" value="Verzenden">
				</form>
				</fieldset>
				
				<?php
			}
			
		}
		elseif($_GET['verzonden'] == 'verzonden') {
			
			$tekst = $_POST['tekst'];
			$van = $_POST['van'];
			$titel = $_POST['titel'];
			$verborgen = $_POST['verborgen'];
			$nummer = $_POST['nummer'];
		
			$bewerk_bericht_versturen = bewerk_bericht_versturen($van,$titel,$tekst,$verborgen,$nummer);
						
			if($bewerk_bericht_versturen) {
				print("Bericht is verzonden.<br />");
				// nieuw bericht opslaan in de log
				$sort = 'bewerk_bericht_versturen';
				save_log($sort,$a_page);
			}
			else {
				print("Bericht kon niet worden verzonden.<br />");
				// nieuw bericht opslaan in de log
				$sort = 'bewerk_bericht_versturen_fail';
				save_log($sort,$a_page);
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
			<form name="" action="?a_page=nieuw_bericht&verzonden=verzonden" method="post">
			<p>Door:<br /><input type="text" name="van" value="Administrator" class="text-long"></p>
			<p>Titel:<br /><input type="text" name="titel" value="Titel" class="text-long"></p>
			<p>Bericht:
			<div id="input"></div>
			<textarea name="tekst"></textarea></p><br />
			<input type="submit" name="submit" value="Verzenden">
			</form>
			</fieldset>
				
			<?php
				
		}
		elseif($_GET['verzonden'] == 'verzonden') {
			
			$tekst = $_POST['tekst'];
			$van = $_POST['van'];
			$titel = $_POST['titel'];
		
			$nieuw_bericht = nieuw_bericht($van,$titel,$tekst);
						
			if($nieuw_bericht) {
				print("Bericht is verzonden.<br />");
				// nieuw bericht opslaan in de log
				$sort = 'nieuw_bericht';
				save_log($sort,$a_page);
			}
			else {
				print("Bericht kon niet worden verzonden.<br />");
				// nieuw bericht opslaan in de log
				$sort = 'nieuw_bericht_fail';
				save_log($sort,$a_page);
			}
			
			
		}
	}
	
	a_bottom();
	
		//pagina opslaan \\
	save_log($code, $_SESSION['id'], $db);
	
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