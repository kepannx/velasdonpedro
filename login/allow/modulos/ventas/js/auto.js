	/**
 * Site : http:www.smarttutorials.net
 * @author muni
 */
$('#nombreCliente').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url :'ajax/ajax.php',
		      			dataType: "json",
						data: {
						   nombresApellidos: request.term,
						   type: 'productos'
						},
						 success: function( data ) {
							 response( $.map( data, function( item ) {
								return {
									label: item,
									value: item
								}
							}));
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 0      	
		      });
		      
		    