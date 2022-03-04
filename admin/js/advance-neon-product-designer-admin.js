(function( $ ) {
	'use strict';

	var $ = jQuery;
	jQuery(document).ready(function( $ ){
		$( '#add-row' ).on('click', function() {
			var row = $( '.empty-row.custom-repeter-text' ).clone(true);
			row.removeClass( 'empty-row custom-repeter-text' ).css('display','table-row');
			row.insertBefore( '#repeatable-fieldset-one tbody>tr:last' );
			return false;
		});

		$( '.remove-row' ).on('click', function() {
			$(this).parents('tr').remove();
			return false;
		});


		jQuery(".getColor").on("change", function(){
			//Get Color
			var color = jQuery(this).val();
			console.log('color: '+color)
			//Show color code
			jQuery(this).siblings(".outputcolor").val(color);
		})

		jQuery(".outputcolor").on("focusout", function(){
			//Get Color
			var color = jQuery(this).val();
			console.log('color: '+color)
			//Show color code
			jQuery(this).siblings(".getColor").val(color);
		})
	});

	
})( jQuery );
