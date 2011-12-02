<?php
/* first setup information:
1. er moet een tabel zijn die de gegevens van de bestanden bij houdt,
dwz: versiecontrole etc.

end first setup information */

/* logfile:

versie 0.0.03: 2-12-2011:
- Scriptcontrole via database.

end logfile */


// module-functies \\

class Head {
	
	public $content;
	function __construct() {
		$db = new Mysqli("adfari.com","myserver_myst","eq,yQ_cL6-T}","myserver_myst");
		$split = substr($_SERVER['SCRIPT_FILENAME'],-10,6);
		$result = $db->query("SELECT * FROM `files` WHERE nummer='$split'");
		if($result) {
			while($con = $result->fetch_assoc()) {
			$this->content = $con;
			}
			
		}
		else{
			echo 'Er is een fout opgetreden in de database: '. $db->error .'';
		}
	}

	public $start = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
			<head>
				<title>Setup new <?php echo $title; ?></title>
				<style type="text/css">
				    * {
						margin: 0;
					}
					html, body {
						height: 100%;
					}
					.wrapper {
						min-height: 100%;
						height: auto !important;
						height: 100%;
						margin: 0 auto -2em;
					}
					.footer, .push {
						margin-left: 1em;
						height: 2em;
					}
				</style>
			</head>

		<body>
			<div class="wrapper">
				<h1>Setup new <?php echo $title; ?></h1>
			';
		
	function show($title) {
		eval ("?>".$this->start);
	}
}

class Bottom {
	public $end = '
				<div class="push"></div>
			</div>
		<div class="footer">
			Versie: <?php echo $version; ?>
		</div>
		</body>
		</html>';

	function show($version) {
		eval ("?>".$this->end);
	}		
}
?>