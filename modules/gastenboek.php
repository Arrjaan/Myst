<?php
// module gastenboek
class guestbook {
	public $content = array("titel"=>"gastenboek","content"=>"hoi");
}

include("module-functies.php");

$d = new head;
$d->show();

?>