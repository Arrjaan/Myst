<?php

class Page {
	function __construct($page = 'home') {
		$db = new Mysqli("adfari.com","myserver_myst","eq,yQ_cL6-T}","myserver_myst");
		echo $db->stat();
	}
}

new Page ();

?>