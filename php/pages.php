<?php

ob_start();

?>
<span id="title">
	<h1><a class="title" href="javascript:edit('title','<?php echo $id; ?>')"><?php echo $title; ?></a></h1> 
</span>
<span id="add"></span><a href="javascript:add()"><img src="html/img/add.png" alt="Pagina Toevoegen" /></a>
<a href="javascript:edit('content','<?php echo $id; ?>')"><img src="html/img/edit.png" alt="Bewerken" /></a>
<a href="javascript:del('<?php echo $id; ?>')" onclick="return confirm('Weet u zeker dat u deze pagina wilt verwijderen?')"><img src="html/img/del.png" alt="Verwijderen" /></a>
<br />
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