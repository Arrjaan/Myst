<?php

if ( isset($_GET['title']) ) 
	echo '<form method="post" id="admin" onsubmit="false">
		<input id="option" name="option" /> 
		<a href=""; onclick="saveEdit();return false;">Update</a>
		</form>';

else echo '<h1 id="edit">'.$_POST['option'].'</h1>';

?>