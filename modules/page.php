<?php

class Page {
	function __construct($page = 'home') {
		$db = new Mysqli("adfari.com","myserver_myst","eq,yQ_cL6-T}","myserver_myst");
		echo $db->stat();
		echo "<br /><br />";
		echo 'Zie <a target="_blank" href="http://adfari.com/phpmyadmin">http://adfari.com/phpmyadmin</a> voor PhpMyAdmin.<br />';
	}
}

new Page;

?>