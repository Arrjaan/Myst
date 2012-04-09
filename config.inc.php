<?php

$config['processor'] = '';
$config['home'] = 'index';
$config['rootdir'] = '/';

// database gegevens \\
$db['server'] = '127.0.0.1';
//$db['server'] = 'sql09.freemysql.net';
$db['user'] = 'root';
//$db['user'] = 'projectmyst';
$db['passw'] = 'd156441';
//$db['passw'] = 'GitMyst';
$db['db'] = 'projectmyst';
$db['port'] = 3306;

// sessies starten \\
//session_start();

//error reporting \\
error_reporting(E_ALL);

//tijdzone NETHERLANDS \\
date_default_timezone_set('Europe/Amsterdam');

?>