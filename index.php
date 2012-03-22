<?php

error_reporting(E_ALL);
date_default_timezone_set('Europe/Amsterdam');
session_start();

require('config.inc.php');
require('main.php');

$page = $_GET['p'];
if ( empty($page) ) $page = 'index';

if ( empty($page) ) redirect('http://'.$_SERVER['HTTP_HOST'].$config['rootdir'].'/'.$config['processor'].$config['home']);
if ( file_exists('php/'.$page.'.php') ) {
	require('php/'.$page.'.php');
}
else echo 'ERRROR!';

if ( $_SESSION['editmode'] == 'doEdit' ) require('html/adminIndex.php');
else require('html/index.php');

?>
