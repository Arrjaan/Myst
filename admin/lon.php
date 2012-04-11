<?php

include("../config.inc.php");
include("main.php");
$db=db($db);
$query = $db->query("CREATE TABLE IF NOT EXISTS `nieuws` (
  `nummer` int(5) NOT NULL,
  `verborgen` tinyint(1) NOT NULL,
  `van` text NOT NULL,
  `datum` text NOT NULL,
  `title` text NOT NULL,
  `tekst` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;") or die (print(mysqli_error($db)));
?>



