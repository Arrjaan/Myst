	/* attach a submit handler to the form */
$("#admin").submit(function(event) {

    /* stop form from submitting normally */
    event.preventDefault(); 
        
    /* get some values from elements on the page: */
    var $form = $( this ),
        value = $form.find( 'input[name="option"]' ).val(),
        url = $form.attr( 'action' );

    /* Send the data using post and put the results in a div */
    $.post( url, { option: value },
		function( data ) {
			$( "#title" ).empty().append( data );
		}
    );
});

$('#edit').click(function() {
	$.get("/php/update.php", { title: "x" }, function(data){
		( "#title" ).empty().append( data );
	});
});