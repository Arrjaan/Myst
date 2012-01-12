<?php

error_reporting(E_ALL);
date_default_timezone_set('Europe/Amsterdam');
session_start();

require('config.inc.php');
require('main.php');

/* Dit stuk moet echt snel herschreven worden! */

$dir = @explode("/",$_SERVER['PATH_INFO']);

if ( empty($dir[1]) ) redirect('http://'.$_SERVER['HTTP_HOST'].$config['rootdir'].'/'.$config['processor'].$config['home']);
if ( file_exists('php/'.$dir[1].'.php') ) {
	error_reporting(E_ERROR);
	require('php/'.$dir[1].'.php');
}
else echo 'ERRROR!';

require('html/index.php');

?>
