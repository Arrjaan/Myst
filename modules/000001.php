<?php
// module gastenboek

/* logfile:


end logfile */

include("000000.php");


/* setup new guestbook */


/* edit existing guestbook */

$head = new Head();
$content = $head->content;
$head->show($content['naam']);


$e = new Bottom;
$e->show($content['versie']);
?>