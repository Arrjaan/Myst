<?php

ob_start();

?>
<span id="title">
	<h1>Pagina niet gevonden</h1>
</span>
De pagina die u probeert te bereiken kon niet gevonden worden.
<?php 

$adminContent = ob_get_contents();
$content = $adminContent;

ob_clean();

?>