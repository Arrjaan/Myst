<?php
// module-functies \\
	$content = array("title"=>"module-functies","version"=>"0.0.2");

class head {
	public $start = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
			<head>
				<title><?php echo $title; ?></title>
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
			<div class="wrapper">';
		
	function show($title) {
		eval ("?>".$this->start);
	}
}

class bottom {
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