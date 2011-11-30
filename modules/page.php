<?php

class Page {
	function __construct($page = 'home') {
		$db = new Mysqli("adfari.com","myserver_myst","eq,yQ_cL6-T}","myserver_myst");
		echo $db->stat();
		echo "<br /><br />";
		echo 'Zie <a target="_blank" href="http://adfari.com/phpmyadmin">http://adfari.com/phpmyadmin</a> voor PhpMyAdmin.<br />';
	}
}

<<<<<<< HEAD
new Page ();
=======
new Page;
>>>>>>> 198ff9f7b3eeadd2de9262eb00b25cd59a36641d

?>