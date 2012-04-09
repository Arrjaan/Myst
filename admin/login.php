<?php
session_start();

#login
$_POST['user'] = 'admin';
$_POST['pass'] = 'admin';
$_POST['log_on'] = 'Doorgaan';

print("start<br />");
print_r($_SESSION);
print_r($_POST);

include("index.php");

print("<br /><br />mid<br />");
print_r($_SESSION);
/*

#logout
$_SESSION['a_page'] = "admin_off";

$_POST['log_on'] = "";

include("index.php");

print("<br /><br />end<br />");
print_r($_SESSION);

exit;
*/
?>