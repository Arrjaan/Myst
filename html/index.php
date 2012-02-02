<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>Myst</title>
		<link href="http://localhost/Myst/html/all_browsers.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
		<script type="text/javascript" src="http://localhost/Myst/html/ajax.js"></script>
		<link rel="shortcut icon" href="http://localhost/Myst/html/img/favicon.ico" />
	</head>

	<body>
	<div id="wrap">
		<div id="head">Titel</div>
			
		<ul id="menu">
			<li><a href="javascript:void(0)" onclick="load('home')">Home</a></li>
			<li><a href="javascript:void(0)" class="adminlogin" rel="#prompt">Admin</a></li>

		</ul>
					
		<div id="content">		
			<?php
						
			//Doorverwijzing bij http-fout.
			if ( isset($_GET['404']) ) echo '<h2>Pagina kon niet gevonden worden. (404)</h2><br />';
			if ( isset($_GET['401']) ) echo '<h2>Dit is een beveiligde pagina, wachtwoord nodig. (401)</h2><br />';
			if ( isset($_GET['403']) ) echo '<h2>Geen toegang. (403)</h2><br />';
			?>
			
			<?php
			//Content printen.
				echo $content;
			?>								
		</div>
	</div>
		
		<div id="onderkant">
		Deze site is gemaakt met Myst
		</div>
		
		<div class="dialog" id="prompt">
			<h2>Inloggen</h2>

			<form>
				<span id="loginmsg"></span>
				<table border="0">
					<tr>
						<td>Gebruikersnaam:&nbsp;</td>
						<td><input id="username" /></td>
					</td>
					<tr>
						<td>Wachtwoord: </td>
						<td><input type="password" id="password" /></td>
					</tr>
				</table>
				<br />
				<button type="submit"> Inloggen </button>
				<button type="button" class="close"> Annuleren </button>
			</form>
			<br />
		</div>
	</body>
</html>