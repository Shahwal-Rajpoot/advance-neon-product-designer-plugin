(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 jQuery('input[name=location]').change(function(){
	    var imageUrl = jQuery( 'input[name=location]:checked' ).val();
	    jQuery('.anpd-editor').css('background-image', 'url(' + imageUrl + ')');
	});

	jQuery('input[name=tube]').change(function() {
	    jQuery('.tube-option').removeClass('anpd-highlight');
	    jQuery(this).parent('.tube-option').addClass('anpd-highlight');
  	});

  	jQuery('input[name=alignment]').change(function() {
	    jQuery('.anpd-alignment-label').removeClass('anpd-alignment-highlight');
	    jQuery(this).parent('.anpd-alignment-label').addClass('anpd-alignment-highlight');
  	});

  	jQuery('input[name=backing]').change(function() {
	    jQuery('.anpd-backing-label').removeClass('anpd-backing-highlight');
	    jQuery(this).parent('.anpd-backing-label').addClass('anpd-backing-highlight');
  	});

  	jQuery('input[name=size]').change(function() {
	    jQuery('.anpd-size-label').removeClass('anpd-size-highlight');
	    jQuery(this).parent('.anpd-size-label').addClass('anpd-size-highlight');
  	});

  	jQuery('input[name=font]').change(function() {
	    jQuery('.anpd-font-label').removeClass('anpd-font-highlight');
	    jQuery(this).parent('.anpd-font-label').addClass('anpd-font-highlight');
	    var font_name = jQuery(this).val();
	    jQuery('.andp-font-button .anpd-font-name').text(font_name);
  	});


  	jQuery('.andp-font-button').on('click', function(e) {
	  jQuery(this).toggleClass('anpd-active');
	  jQuery(".font-options").slideToggle();
	  e.preventDefault()
	});

  	jQuery('input[name=color]').change(function() {
	    var color = jQuery(this).val();
	    jQuery('.option-two').css('background-color', color);
  	});

})( jQuery );
