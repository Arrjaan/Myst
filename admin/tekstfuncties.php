<?PHP

/*
########################
# © 2010 Peter Postema #
# ~ SideShoreSports ~  # 
#  tekstfuncties.php   #
########################
*/

/*
naam
kop
tekst
*/

function get_page($naam) {

	$query = mysql_query("SELECT * FROM pagina WHERE naam='$naam'");
	
	if($query != "") {
		$query = mysql_fetch_assoc($query);
		$pagina = $query['kop'] . "<br />" . bb_codes($query['tekst']);
	}
	else {
		print("pagina is niet gevonden, http 404");
	}
	return($pagina);
}

?>