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




?>
