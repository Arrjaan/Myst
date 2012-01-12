<?php

if ( isset($_GET['title']) ) 
	echo '<form id="admin" action="/Myst/php/update.php">
		<input name="option" /> 
		<input type="submit" value="Update" />
	</form>';

else echo '<h1 id="edit">'.$_POST['option'].'</h1>';

?>