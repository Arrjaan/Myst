<?php
// module gastenboek
	$content = array("title"=>"gastenboek","version"=>"0.0.2");

include("module-functies.php");

$d = new head;
$d->show($content['title']);


$e = new bottom;
$e->show($content['version']);
?>