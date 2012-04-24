<?php

$config['title'] = 'Myst';

$config['processor'] = '';
$config['home'] = 'index';
$config['rootdir'] = '/';

// database gegevens \\
$db['server'] = 'sql09.freemysql.net';
$db['user'] = 'projectmyst';
$db['passw'] = 'GitMyst';
$db['db'] = 'projectmyst';
$db['port'] = 3306;


// sessies starten \\
session_start();

//error reporting \\
error_reporting(0);

//tijdzone NETHERLANDS \\
date_default_timezone_set('Europe/Amsterdam');

// hash \\
if(!isset($_SESSION['hash'])) {
	$_SESSION['hash'] = "1";
}

// id \\
if(!isset($_SESSION['id'])) {
	$_SESSION['id'] = "empty";
}

?>