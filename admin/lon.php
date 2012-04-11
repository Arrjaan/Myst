<?php

include("../config.inc.php");
include("main.php");
$db=db($db);
$query = $db->query("CREATE TABLE `log` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(3) NOT NULL,
  `ip` text NOT NULL,
  `date` text NOT NULL,
  `code` int(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;") or die (print(mysqli_error($db)));
?>



