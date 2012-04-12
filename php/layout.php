<?php
ob_start();

check_login($_SESSION['hash'],$_SESSION['id'],$db)

require('html/layout.php');

$content = ob_get_contents();
$adminContent = $content;

ob_clean();

?>