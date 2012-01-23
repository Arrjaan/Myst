<?php

if ( isset($_GET['title']) ) 
	echo '<form method="post" id="admin" onsubmit="return false">
		<input id="option" name="option" onkeypress="onEnter(event);" /> 
		<a href=""; onclick="saveEdit();return false;">Update</a>
		</form>';

else echo '<h1><a href="javascript:edit()">'.$_POST['option'].'</a></h1></h1>';

?>