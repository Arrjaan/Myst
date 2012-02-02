<?PHP

/*
########################
# © 2010 Peter Postema #
# ~ SideShoreSports ~  # 
#   conf.inc.php       #
########################
*/

	#####################
	//Huishoudelijke dingen
	#####################
	
	//session
	session_start();


	//error reporting
	error_reporting(E_ALL);


	//tijdzone NETHERLANDS
	date_default_timezone_set('Europe/Amsterdam');
	
	
	#####################


	#####################
	//database connectie
	#####################
	
	$db['server'] = 'sql09.freemysql.net';
	$db['user'] = 'projectmyst';
	$db['passw'] = 'GitMyst';
	$db['db'] = 'projectmyst';

	$db['connect'] = @mysql_connect( $db['server'], $db['user'], $db['passw'] );
	$db['passw'] = '';
	$db['selectDb'] = @mysql_select_db( $db['db'], $db['connect'] );

	if ( $db['connect'] ){
		if ( $db['selectDb'] )	{
			// print("Alle connecties gingen goed en de database is geselecteerd!");
		}
		else{
			//print( '<p style="font-family: Tahoma; font-size: 11px;">MySQL : Er kon geen database geselecteerd worden. <i>(Database: ' . $db['db'] . ')</i></p>' );
		}
	}
	else
	{
		//print( '<p style="font-family: Tahoma; font-size: 11px;">MySQL : Er kon geen verbinding gemaakt worden <i>(' . $db['user'] . '@' . $db['server'] . ')</i></p>');
	}

	$db = '';

	#####################


	#####################
	//een aantal zakelijke dingen
	#####################	
	
	include("nieuwsfuncties.php");
	include("tekstfuncties.php");

	#####################
	
		
//bb-codes
function bb_codes($bericht) {

	//include("nieuwsfuncties.php");
	//$verborgen = '0';
	//$nieuwsbox = zien_berichten($verborgen);

	$lijst_codes = array('[br]','[b]','[/b]','[u]','[/u]','[i]','[/i]','[url=','/]','[/url]');
	$lijst_html = array('<br />','<b>','</b>','<u>','</u>','<i>','</i>','<a href=\'','\'>','</a>');
	$bericht = str_replace($lijst_codes, $lijst_html, $bericht);
	
	return($bericht);
}

function naar_br($tekst) {

	$replace = array("\r\n", "\r", "\n", "<", ">");
	$new = array("[br]", "[br]", "[br]", "&lt;", "&gt;");
	$tekst = str_replace($replace, $new, $tekst);

	return($tekst);
}

//Logboek
function save_log($sort, $a_page) {

	$ip = getRealIpAddr();
	$date = date('r');
	
	$query = mysql_query("SELECT * FROM admin");
	$nummer = mysql_num_rows($query);
	$nummer++;

	if($sort == "login") {
		$regel = ":: $date :: Bezoeker logt in vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}
	elseif($sort == "login_fail") {
		$regel = ":: $date :: Bezoeker geeft verkeerd wachtwoord op vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}
	elseif($sort == "logout") {
		$regel = ":: $date :: Bezoeker logt uit vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}
	elseif($sort == "pagina") {
		$regel = ":: $date :: Bezoeker krijgt de pagina \"$a_page\" te zien vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}
	elseif($sort == "nieuw_bericht") {
		$regel = ":: $date :: Bezoeker plaatst een nieuw bericht vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}	
	elseif($sort == "nieuw_bericht_fail") {
		$regel = ":: $date :: Bezoeker kon geen nieuw bericht plaatsen vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}	
	elseif($sort == "verwijder_bericht") {
		$regel = ":: $date :: Bezoeker verwijderd een bericht vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}	
	elseif($sort == "verwijder_bericht_fail") {
		$regel = ":: $date :: Bezoeker kon geen bericht verwijderen vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}
	elseif($sort == "bewerk_bericht_versturen") {
		$regel = ":: $date :: Bezoeker bewerkte een bericht vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}	
	elseif($sort == "bewerk_bericht_versturen_fail") {
		$regel = ":: $date :: Bezoeker kon geen bericht bewerken vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}	
	elseif($sort == "verborgen_bericht") {
		$regel = ":: $date :: Bezoeker veranderde de zichtbaarheid van een bericht vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}	
	elseif($sort == "verborgen_bericht_fail") {
		$regel = ":: $date :: Bezoeker kon de zichtbaarheid van een bericht niet veranderen vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}	
	elseif($sort == "failure") {
		$regel = ":: $date :: Bezoeker krijgt een foutmelding te zien vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}	
	else {
		$regel = ":: $date :: Bezoeker krijgt een pagina te zien die niet is opgenomen in het systeem vanaf $ip.";
		$query = mysql_query("INSERT INTO admin VALUES('$nummer','$regel')");
	}	
	print(mysql_error());
}
	

//Echt ip-adres
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


//dagen omrekenen
function ned_dag($dag) {
	for($i=1;$i<=7;$i++) {
		if($dag == $i) {
			$ned_dag = array('','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag','Zondag');
			$dag = $ned_dag[$i];
		}
	}
	return($dag);
}


//maanden omrekenen
function ned_maand($maand) {
	for($i=1;$i<=12;$i++) {
		if($maand == $i) {
			$ned_maand = array('','Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December');
			$maand = $ned_maand[$i];
		}
	}
	return($maand);
}


// datum en tijd
function tijd() {

	$dag = date("N");
	$dag = ned_dag($dag);
	$maand = date("n");
	$maand = ned_maand($maand);
	$datum = $dag . " " . date("j") . " " . $maand . " " . date("Y H:i:s");

	return($datum);
}


//head
function head($a_page) {

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
		print('<li><a href="?a_page=home" class="active">Home</a></li>');
	}
	else {
		print('<li><a href="?a_page=home">Home</a></li>');
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
				<li><a href="?a_page=home"'); if($a_page == "home") { print('class="active"'); } else { ; } print('>Home</a></li>
				<li><a href="?a_page=server"'); if($a_page == "server") { print('class="active"'); } else { ; } print('>Serverstatus</a></li>
				<li><a href="?a_page=website"'); if($a_page == "website") { print('class="active"'); } else { ; } print('>Websitestatus</a></li>
			</ul>
			<!-- // .sideNav -->
		</div>    
		<!-- // #sidebar -->
		
		<!-- h2 stays for breadcrumbs -->
		<h2><a href="?a_page=home"'); if($a_page == "home") { print('class="active">Home</a>'); } 
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
function bottom() {
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
