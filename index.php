<?php

error_reporting(E_ERROR);
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

require('html/index.php');

?>
