<?php

$config['processor'] = '';
$config['home'] = 'index';
$config['rootdir'] = '/';

// database gegevens \\
$db['server'] = 'sql09.freemysql.net';
$db['user'] = 'projectmyst';
$db['passw'] = 'GitMyst';
$db['db'] = 'projectmyst';







/// VERPLAATSEN SPV


//head_admin
function a_head($a_page) {

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
		print('<li><a href="?a_page=berichten" class="active">Berichten</a></li>');
	}
	else {
		print('<li><a href="?a_page=berichten">Berichten</a></li>');
	}
	//beheerders
	if($a_page == "beheerders" OR $a_page == "nieuwe_beheerder") {
		print('<li><a href="?a_page=beheerders" class="active">Beheerders</a></li>');
	}
	else {
		print('<li><a href="?a_page=beheerders">Beheerders</a></li>');
	}
	//logboek
	if($a_page == "log") {
		print('<li><a href="?a_page=log" class="active">Logboek</a></li>');
	}
	else {
		print('<li><a href="?a_page=log">Logboek</a></li>');
	}
	//logout
	print('
	        	<li class="logout"><a href="?a_page=admin_off">LOGOUT</a></li>
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
				<li><a href="?a_page=server"'); if($a_page == "server") { print('class="active"'); } else { ; } print('>Serverstatus</a></li>
				<li><a href="?a_page=website"'); if($a_page == "website") { print('class="active"'); } else { ; } print('>Websitestatus</a></li>
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
	elseif($a_page == "log") {
	print('        		
		<div id="sidebar">
			<ul class="sideNav">
				<li><a href="?a_page=log"'); if($a_page == "log") { print('class="active"'); } else { ; } print('>Logboek</a></li>
			</ul>
			<!-- // .sideNav -->
		</div>    
		<!-- // #sidebar -->
		
		<!-- h2 stays for breadcrumbs -->
		<h2><a href="?a_page=log"'); if($a_page == "log") { print('class="active">Logboek</a>'); } 
		/*else { 
			print('>Logboek</a> &raquo; <a href="?a_page=' . $a_page . '" class="active">'); 
			if($a_page == "server") { print('Serverstatus'); } 
			elseif($a_page == "website") { print('Websitestatus'); } 
			print('</a></h2>'); 
		} */
			print('</a></h2>'); 
	}		
	//beheerders
	elseif($a_page == "beheerders" OR $a_page == "nieuwe_beheerder") {
	print('        		
		<div id="sidebar">
			<ul class="sideNav">
				<li><a href="?a_page=beheerders"'); if($a_page == "beheerders") { print('class="active"'); } else { ; } print('>Beheerders</a></li>
				<li><a href="?a_page=nieuwe_beheerder"'); if($a_page == "nieuwe_beheerder") { print('class="active"'); } else { ; } print('>Beheerder toevoegen</a></li>
			</ul>
			<!-- // .sideNav -->
		</div>    
		<!-- // #sidebar -->
		
		<!-- h2 stays for breadcrumbs -->
		<h2><a href="?a_page=beheerders"'); if($a_page == "beheerders") { print('class="active">Beheerders</a>'); } 
		else { 
			print('>Beheerders</a> &raquo; <a href="?a_page=' . $a_page . '" class="active">'); 
			if($a_page == "nieuwe_beheerder") { print('Beheerder toevoegen'); } 
		} 
			print('</a></h2>'); 
	}			
	//berichten
	if($a_page == "berichten" OR $a_page == "nieuw_bericht" OR $a_page == "bewerk_bericht" OR $a_page == "verwijder_bericht") {
	print('        		
		<div id="sidebar">
			<ul class="sideNav">
				<li><a href="?a_page=berichten"'); if($a_page == "berichten") { print('class="active"'); } else { ; } print('>Berichten</a></li>
				<li><a href="?a_page=nieuw_bericht"'); if($a_page == "nieuw_bericht") { print('class="active"'); } else { ; } print('>Bericht toevoegen</a></li>
				<li><a href="?a_page=bewerk_bericht"'); if($a_page == "bewerk_bericht") { print('class="active"'); } else { ; } print('>Bericht bewerken</a></li>
				<li><a href="?a_page=verwijder_bericht"'); if($a_page == "verwijder_bericht") { print('class="active"'); } else { ; } print('>Bericht verwijderen</a></li>
			</ul>
			<!-- // .sideNav -->
		</div>    
		<!-- // #sidebar -->
		
		<!-- h2 stays for breadcrumbs -->
		<h2><a href="?a_page=berichten"'); if($a_page == "berichten") { print('class="active">Berichten</a>'); } 
		else { 
			print('>Berichten</a> &raquo; <a href="?a_page=' . $a_page . '" class="active">'); 
			if($a_page == "nieuw_bericht") { print('Bericht toevoegen'); } 
			elseif($a_page == "bewerk_bericht") { print('Bericht bewerken'); } 
			elseif($a_page == "verwijder_bericht") { print('Bericht verwijderen'); } 
		} 
			print('</a></h2>'); 
	}	
print('<br /><br /><div id="main">');
}

//bottom
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