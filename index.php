<?php

error_reporting(E_ALL);
date_default_timezone_set('Europe/Amsterdam');
session_start();

require('config.inc.php');
require('main.php');


$dir = @explode("/",$_SERVER['PATH_INFO']);

if ( $config['stats'] ) $var = new Stats;

$var = new Secure;
$var->sync();
if ( !empty($_GET['t']) ) $_SESSION['t'] = $_GET['t'];
if ( !empty($_SESSION['t']) ) $template = $_SESSION['t'];

if ( $config['stats'] ) Stats::pageview($dir[1]);

if ( empty($dir[1]) ) Url::header_redirect('http://'.$_SERVER['HTTP_HOST'].$config['rootdir'].'/'.$config['processor'].$config['home']);
if ( file_exists('files/PHP/'.$dir[1].'.php') ) require('files/PHP/'.$dir[1].'.php');
else Url::header_redirect('http://'.$_SERVER['HTTP_HOST'].$config['rootdir'].'/'.$config['processor'].$config['home'].'/notfound/');

if ( empty($dir[2]) ) $dir[2] = 'index';
if ( empty($dir[3]) ) $dir[3] = '';

Page::$dir[2]($dir[3],$dir[4],$dir[5]);

?>
