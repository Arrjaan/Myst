<?php

require('config.inc.php');
require('main.php');

@$page = $_GET['p'];
if ( empty($page) ) $page = 'index';

$q = $db->query("select * from `webpages` where `short` = '".$page."'");
echo $db->error;

switch ( $page ) {
	case ( $q->num_rows > 0 ):
		$page = $q->fetch_assoc();
		$id = $page['pageid'];
		$title = $page['pagename'];
		$source = $page['content'];
		require('php/pages.php');
		break;
	case ( file_exists('php/'.$page.'.php') ):
		require('php/'.$page.'.php');
		break;
	default:
		require('php/notfound.php');
		break;
}

require('html/index.php');

?>
