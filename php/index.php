<?php

ob_start();

?>
<span id="title">
	<h1><a class="title" href="javascript:edit()">Titel</a></h1>
</span>

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis euismod, felis molestie hendrerit varius, nulla dui interdum ipsum, ut malesuada nibh eros eget lacus. Proin a sem nunc. Suspendisse rhoncus, tortor sed gravida viverra, dolor libero lobortis erat, et egestas est tortor sit amet diam. Quisque ut eros non odio egestas gravida. Aenean consectetur vestibulum eleifend. Nullam nibh ante, semper sit amet feugiat malesuada, rutrum sit amet lectus. Cras pharetra posuere porta. Nunc facilisis tincidunt vehicula.

Nunc malesuada gravida justo, quis eleifend felis ultrices vel. Vestibulum ut egestas tortor. Ut imperdiet dictum neque a suscipit. Mauris enim est, dapibus vitae feugiat eget, pretium ac purus. Vivamus scelerisque eleifend odio, ut feugiat urna iaculis id. Aliquam viverra libero a nisl sodales adipiscing. Maecenas lacinia sagittis massa sed mattis. Sed posuere urna et neque rutrum id commodo lorem lobortis. Vivamus placerat ornare varius. Fusce mi orci, fermentum vel eleifend ut, accumsan et turpis. Integer sit amet turpis a neque sollicitudin dictum vitae vitae enim. Cras leo orci, malesuada non tempus et, consequat id massa. Curabitur mollis enim a ligula ullamcorper rutrum. Aliquam tempus felis a neque faucibus ac dapibus tortor aliquet.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus semper, metus tincidunt accumsan interdum, urna nibh aliquam orci, eu suscipit dolor eros a quam. Donec ut enim massa, ac elementum felis. Nulla facilisi. Integer vehicula diam at orci tempor egestas. Pellentesque vestibulum fermentum felis, vel dapibus nunc condimentum eu. Phasellus vehicula diam dolor. In varius porta mi a euismod.

Donec justo enim, dignissim quis molestie congue, rhoncus a magna. Morbi pellentesque semper adipiscing. Mauris euismod tincidunt sollicitudin. Pellentesque pharetra dapibus lectus ac suscipit. Ut at diam faucibus quam aliquet lobortis. Donec facilisis aliquet pretium. Etiam placerat vestibulum ornare. Suspendisse potenti. Pellentesque vehicula libero at nibh facilisis non consequat metus commodo. Mauris neque purus, accumsan id consequat ut, tincidunt et felis. Nunc ac quam eu neque volutpat venenatis. In orci magna, mollis et porta eu, imperdiet vitae lorem.

Pellentesque dignissim bibendum blandit. Nullam vulputate lacinia ligula ut mollis. Quisque sit amet ullamcorper nisi. Pellentesque venenatis rutrum tortor nec iaculis. Maecenas sed laoreet orci. Quisque quis massa vitae libero tempor tincidunt. In hac habitasse platea dictumst. Etiam volutpat tempus nulla, id adipiscing diam congue aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam vehicula placerat lacinia. 
<?php

$content = ob_get_contents();

ob_clean();

?>