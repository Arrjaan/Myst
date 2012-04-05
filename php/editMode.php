<?php

if ( isset($_GET['stop']) ) {
	$_SESSION['editmode'] = '';
	header('Location: ?p=index');
}
else {
	$_SESSION['editmode'] = 'doEdit';
	header('Location: ?p=index');
}

?>