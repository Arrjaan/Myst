<?php

ob_start();

?>
<span id="title">
	<h1><a class="title" href="javascript:edit('title','<?php echo $id; ?>')"><?php echo $title; ?></a></h1> 
	<a href="javascript:edit('content','<?php echo $id; ?>')">Bewerken</a>
</span>
<?php 

echo '<span id="innerContent">'.nl2br($source).'</span>'; 

$adminContent = ob_get_contents();

ob_clean();
ob_start();

?>
<span id="title">
	<h1><?php echo $title; ?></h1>
</span>
<?php 

echo '<span id="innerContent">'.nl2br($source).'</span>';

$content = ob_get_contents();

ob_clean();

?>