<?php

function logged_on($string) {
	
	//$con-> 
	
	
	
	return(true);
	
	
	return(false);
}

function log_in() {

	$salt = rand(9999,99999);
	$rand = rand(1000,9999);
	$rand = md5($rand);
	$rand = $rand . (time() * '3,14156' * rand(1,9));
	$rand = sha1($rand,33);
	$rand = md5($rand);
	$rand = $rand . $salt;
	$rand = str_split($rand,32);
	$random = $rand[0];
	return($random);
}

$hoi = log_in();
print($hoi);
?>