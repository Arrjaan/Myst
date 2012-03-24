<?php

ob_start();

?>
<span id="title">
	<h1><a class="title" href="javascript:edit('title','<?php echo $id; ?>')"><?php echo $title; ?></a></h1>
</span>
<?php 

echo nl2br($source); 

$adminContent = ob_get_contents();

ob_clean();
ob_start();

?>
<span id="title">
	<h1><?php echo $title; ?></h1>
</span>
<?php 

echo nl2br($source);

$content = ob_get_contents();

ob_clean();

?>