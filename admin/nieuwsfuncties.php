<?PHP

/* 
########################
# © 2010 Peter Postema #
# ~ SideShoreSports ~  # 
# nieuwsfuncties.php   #
########################
*/

# NOTE: als $verborgen 'true' is dan wordt het bericht verborgen.

// berichten zien
function zien_berichten($verborgen) {

	if($verborgen == "1") {
		
		$query = mysql_query("SELECT * FROM nieuws ORDER BY nummer DESC");
		$i = "0";

		while(list($nummer,$verborgen,$van,$datum,$titel,$bericht) = mysql_fetch_row($query)) {
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
					<a href='?a_page=bewerk_bericht&nummer=$nummer'>Dit bericht bewerken.</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='?a_page=verwijder_bericht&nummer=$nummer'>Dit bericht verwijderen.</a>
					<table class=\"nieuws\">
					<tr><td>Nummer:</td><td class='nieuws'>$nummer</td></tr>
					<tr><td>Verborgen:</td><td class='nieuws'>$verborgen</td></tr>
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
		
		$query = mysql_query("SELECT * FROM nieuws WHERE verborgen = '$verborgen' ORDER BY nummer DESC");
		while(list($nummer,$verborgen,$van,$datum,$titel,$bericht) = mysql_fetch_row($query)) {
		
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
		
		$query = mysql_query("SELECT * FROM nieuws ORDER BY nummer DESC");
		$i = "0";

		while(list($nummer,$verborgen,$van,$datum,$titel,$bericht) = mysql_fetch_row($query)) {
			$i = $i + "1";
			
			print("	
					<table onClick=\"showHide('file_" . $nummer . "')\" style='margin-top: 5px; cursor: pointer;'>
					<tr><td class='nummer'>#$nummer</td><td class='datum'>$datum</td><td class='punten'>::</td><td class='titel'>$titel</td><td class='punten'>::</td></tr>
					</table>
					
					<div id='file_" . $nummer . "' style='background: #ddd; display: none; padding: 3px 5px 5px 5px; visibility: hidden;'>
					<a href='?a_page=bewerk_bericht&nummer=$nummer'>Dit bericht bewerken.</a>
					</div>
			");
		}
		
		if($i == "0") {
			print("<tr><td>Er zijn geen berichten.</td></tr>");
		}
		
	}
	
	
	elseif($verborgen == "8") {
		
		$query = mysql_query("SELECT * FROM nieuws ORDER BY nummer DESC");
		$i = "0";

		while(list($nummer,$verborgen,$van,$datum,$titel,$bericht) = mysql_fetch_row($query)) {
			$i = $i + "1";
			
			print("	
					<table onClick=\"showHide('file_" . $nummer . "')\" style='margin-top: 5px; cursor: pointer;'>
					<tr><td class='nummer'>#$nummer</td><td class='datum'>$datum</td><td class='punten'>::</td><td class='titel'>$titel</td><td class='punten'>::</td></tr>
					</table>
					
					<div id='file_" . $nummer . "' style='background: #ddd; display: none; padding: 3px 5px 5px 5px; visibility: hidden;'>
					<a href='?a_page=verwijder_bericht&nummer=$nummer'>Dit bericht verwijderen.</a>
					</div>
			");
		}
		
		if($i == "0") {
			print("<tr><td>Er zijn geen berichten.</td></tr>");
		}
		
	}
	

}

//bericht bewerken
function bewerk_bericht($nummer) {

	$query = mysql_query("SELECT * FROM nieuws");
	$aantal = mysql_fetch_row($query);

	if($nummer <= $aantal) {

	$query = mysql_query("SELECT * FROM nieuws WHERE nummer=$nummer");
	$query = mysql_fetch_assoc($query);

	$query['tekst'] = str_replace("[br]", "\n", $query['tekst']);
	
	return($query);
	}
	else {
		$fout = "Bericht bestaat niet.";
		return($fout);
	}
}

//berwerkt bericht versturen
function bewerk_bericht_versturen($van,$titel,$tekst,$verborgen,$nummer) {
	
	$tekst = naar_br($tekst);
	
	$query = mysql_query("UPDATE nieuws SET verborgen='$verborgen', van='$van', title='$titel', tekst='$tekst'  WHERE nummer='$nummer'");
		
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
function nieuw_bericht($van,$titel,$tekst) {

	$datum = tijd();
	
	$query = mysql_query("SELECT nummer FROM nieuws ORDER BY nummer DESC");
	$nummer = mysql_fetch_row($query);
	$nummertje = $nummer[0] + 1;
	$verborgen = "1"; //standaard verborgen
	
	$tekst = naar_br($tekst);
	
	$query = mysql_query("INSERT INTO nieuws(nummer,verborgen,van,datum,title,tekst) VALUES ('$nummertje','$verborgen','$van','$datum','$titel','$tekst')");
	
	if($query) {
		$nieuw_bericht = true;
		//print("Uw bericht is succesvol toegevoegd aan de database!<br />");
	}
	else {
		$nieuw_bericht = false;
		//print("Uw bericht kon niet worden toegevoegd aan de database.<br />Probeer het later nog eens.<br />");
	}

	return($nieuw_bericht);
}

//bericht verwijderden
function verwijder_bericht($nummer) {

	$query = mysql_query("DELETE FROM nieuws WHERE nummer='$nummer'");
	
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
function verborgen_bericht($nummer) {

	$query = mysql_query("SELECT verborgen FROM nieuws WHERE nummer='$nummer'");
	$verborgen = mysql_fetch_row($query);
	
	if($verborgen['0'] == "0") { // zichtbaar naar verborgen
		$verborgen['0'] = "1";
	}
	elseif($verborgen['0'] == "1") { // verborgen naar zichtbaar
		$verborgen['0'] = "0";
	}
	
	$verborgen = $verborgen['0'];
	
	$query = mysql_query("UPDATE nieuws SET verborgen='$verborgen' WHERE nummer='$nummer'");
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
?>