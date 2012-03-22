<?php
ob_start();

require('html/layout.php');

$content = ob_get_contents();

ob_clean();

?>