<?php

$config['title'] = 'Titel';

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
error_reporting(E_ALL);

//tijdzone NETHERLANDS \\
date_default_timezone_set('Europe/Amsterdam');

?>