<?php
// module-functies \\

class head {
	public $start = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
			<head>
				<title>help</title>
			</head>

		<body>';
		
	function show() {
		echo $start;
	}
}

class bottom {
	public $end = '
		</body>
		</html>';
}
?>