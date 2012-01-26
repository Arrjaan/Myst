<?php

ob_start();

?>
<span id="title">
	<h1><a class="title" href="javascript:edit()">Titel</a></h1>
</span>

<script src="/Myst/html/ajax.js">
</script>	
<?php

$content = ob_get_contents();

ob_clean();

?>