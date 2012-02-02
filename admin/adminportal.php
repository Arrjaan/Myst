<?php
/*
########################
# © 2010 Peter Postema #
# ~ SideShoreSports ~  # 
#   adminportal.php    #
########################
*/

	include("conf.inc.php");

	if(isset($_GET['a_page'])) {
		$_SESSION['a_page'] = $_GET['a_page'];
	}
	if(!isset($_SESSION['a_page'])) {
		$_SESSION['a_page'] = "home";
	}

	$a_page = $_SESSION['a_page'];
	

	if(!isset($_SESSION['admin_on'])) {
		$_SESSION['admin_on'] = "";
	}

	//uitloggen
	elseif($a_page == "admin_off") {
		$_SESSION['admin_on'] = "";
		
		//pagina opslaan
		$sort = 'logout';
		save_log($sort,$a_page);
	}

	// Inloggen
	if(isset($_POST['log_on'])) {
		if($_POST['log_on'] == "Doorgaan") {
			
				$logon = mysql_query("SELECT id FROM users WHERE username='" . $_POST['user'] . "'");
				$logon = mysql_fetch_assoc($logon);
				if($logon['id'] == "") {
					//print(" gebruiker bestaat niet ");
				}
				elseif($logon['id'] != "") {
					$logon = mysql_query("SELECT password FROM users WHERE id='" . $logon['id'] . "'");
					$logon = mysql_fetch_assoc($logon);
					if($logon['password'] == md5($_POST['pass'])) {
						
						$_SESSION['admin_on'] = "admin_logged_on";
						$_SESSION['id'] = $logon['id'];
					
						// goede login, opslaan
						$sort = 'login';
						save_log($sort,$a_page);
						
						die("SUCCESS");
					}
					else {
						die("FAILURE");
					}
				}
				else {
					die("FAILURE");
				}
				
				if($_SESSION['admin_on'] != "admin_logged_on") {
					$_SESSION['admin_on'] = "Not_True";
					
					//foute login, opslaan
					$sort = 'login_fail';
					save_log($sort,$a_page);
					die("FAILURE");
				}
				else {
					;
				}
		}
	}

	if($_SESSION['admin_on'] != "admin_logged_on") {

		$_SESSION['include_css'] = "include";
		print('<html><head><link rel="stylesheet" type="text/css" href="login.css" /><script type="text/javascript" src="js/functions.js"></script></head><body>');
		
		print("	<div class='blok'>
					<div class='blok_key'>Logo<br />Myst.nl</div>
					<div class='blok_tekst'>Beheerderspaneel van MystCMS,<br /> graag eerst inloggen.</div>
					<div class='blok_inloggen'>");
		if(isset($_POST['log_on'])) { 
			print("<font color='red'>Foutieve logingegevens.</font><br /><br />");
		}
		else {
			print("<br /><br />");
		}
			print("		<form name='login' id='login' action='adminportal.php?a_page=home' method='post'>
						Gebruikersnaam:<br /><input class='blok_gebruiker' type='text' name='user' value='gebruiker' /><br />
						<br />
						Wachtwoord:<br /><input class='blok_wachtwoord' type='password' name='pass' value='wachtwoord' /><br />
						<br />
						<br />
						<center><input type='submit' value='Doorgaan' name='log_on' /></center>
						</form>
					</div>
		
				</div>");

		print('</body></html>');
		
	}

	elseif($_SESSION['admin_on'] == "admin_logged_on") {
		
		//pagina opslaan
		$sort = 'pagina';
		save_log($sort,$a_page);
		
		//head
		head($a_page);
		
		// Begin scherm
		if($a_page == "home") {
			print("Welkom in het beheerderspaneel.<br /><br />");
		}
		
		if($a_page == "log") {
			$query = mysql_query("SELECT * FROM admin ORDER BY nummer DESC");
				print("<table><tr><td>nummer</td><td></td><td>actie</td></tr>");
			while(list($nummer,$regel) = mysql_fetch_row($query)) {
				print("<tr><td>#$nummer</td><td></td><td>$regel</td></tr>");
			}
				print("</table><br /><br />");
		}
		
		if($a_page == "beheerders") {
			$query = mysql_query("SELECT nummer,naam FROM administrator");
				print("<table><tr><td>nummer</td><td></td><td>naam</td><td></td><td>wachtwoord</td></tr>");
			while(list($nummer,$naam) = mysql_fetch_row($query)) {
				print("<tr><td>#$nummer</td><td></td><td>$naam</td><td></td><td>**********</td></tr>");
			}
				print("</table><br /><br />");
		}
		
		if($a_page == "nieuwe_beheerder") {
			print("service tijdelijk niet beschikbaar.");
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
		
		bottom();
	}
	else {
		
		// onbekende fout
		$sort = 'failure';
		save_log($sort,$a_page);
		
		print("Onbekende fout.");
	}

?>