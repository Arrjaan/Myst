<?php

class Module {
	public $name = 'Voorbeeld Module'; // Volledige naam module
	public $modid = 000001; // Id van de module, voor in centrale database.
	public $version = '0.1'; // Versienummer
	public $author = 'Arjan'; // Ontwikkelaar van module.
	
	public $pages = array('add','del','edit'); // Pagina's die deze module accepteerd. In dit geval dus http://site.nl/Module/add 
			
	function __construct($page = 'home') {
		query("QUERY MET TABLES DIE NODIG ZIJN.");
	}
	function page($l = 'add') { // $l = 'add' geeft de standaardpagina aan.
		$p = new Page($l);
		$p->layout(); 
		
		switch ($l) {
			case 'add':
				$l->content = 'Pagina toevoegen.';
				break;
			case 'edit':
				$l->content = 'Pagina bewerken.';
				break;
			case 'del':
				$l->content = 'Pagina verwijderen.';
				break;
		}
		
		$p->show(); // Toont de pagina.
	}
	function install() {
		// Extra instellingen voor bij het installeren van de module.
	}
}

?>