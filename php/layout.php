<?php
ob_start();

require('html/layout.php');

$content = ob_get_contents();
$adminContent = $content;

ob_clean();

?>