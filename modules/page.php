<?php

class Page {
	var $html;
	var $content;
	
	function __construct($page = 'home') {
		$db = new Mysqli("adfari.com","myserver_myst","eq,yQ_cL6-T}","myserver_myst");
		echo $db->stat();
		echo "<br /><br />";
		echo 'Zie <a target="_blank" href="http://adfari.com/phpmyadmin">http://adfari.com/phpmyadmin</a> voor PhpMyAdmin.<br />';
	}
	function layout($l = 'default') {
		$l = new Layout($l);
		$html = $l->getHTML(); // Zorg voor een class Layout die bij de functie getHTML alle HTML voor de pagina laat zien.
	}
	function show() {
		extract($content);
		eval("?>".$html);
	}
}

new Page;

?>