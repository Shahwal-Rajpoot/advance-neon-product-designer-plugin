(function( $ ) {
	'use strict';

	var $ = jQuery;
	jQuery(document).ready(function( $ ){
		$( '.add-row' ).on('click', function() {
			var row = $(this).parents('.inside').find( '.empty-row.custom-repeter-text' ).clone(true);
			row.removeClass( 'empty-row custom-repeter-text' ).css('display','table-row');
			row.insertBefore( $(this).parents('.inside').find('.anpd-table tbody>tr:last') );
			row.find(".font-options").addClass('anpd-font-select').select2({});
			row.find(".anpd-font-select").removeClass('font-options');
			return false;
		});

		$( '.remove-row' ).on('click', function() {
			$(this).parents('tr').remove();
			return false;
		});

		// update input value from colors input
		jQuery(".getColor").on("change", function(){
			//Get Color
			var color = jQuery(this).val();
			console.log('color: '+color)
			//Show color code
			jQuery(this).siblings(".outputcolor").val(color);
		})
		
		// update input color value from input
		jQuery(".outputcolor").on("focusout", function(){
			//Get Color
			var color = jQuery(this).val();
			console.log('color: '+color)
			//Show color code
			jQuery(this).siblings(".getColor").val(color);
		})

		$(":not(.empty-row) .anpd-font-select").select2({});
	});

	
})( jQuery );
