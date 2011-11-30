<?php

class Page {
	public $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title><?php echo $titel; ?></title>
	</head>

	<body>
	<?php echo $content; ?>
	</body>
</html>';
	public $content = array(
	"titel" => "Test Pagina",
	"content" => 'Zie <a href="http://adfari.com/phpmyadmin">http://adfari.com/phpmyadmin</a>');
	
	function __construct($page = 'home') {
		$db = new Mysqli("adfari.com","myserver_myst","eq,yQ_cL6-T}","myserver_myst");
	}
	function layout($l = 'default') {
		$l = new Layout($l);
		$html = $l->getHTML(); // Zorg voor een class Layout die bij de functie getHTML alle HTML voor de pagina laat zien.
	}
	function show() {
		extract($this->content);
		eval("?>".$this->html);
	}
}

$p = new Page;
$p->show();

?>