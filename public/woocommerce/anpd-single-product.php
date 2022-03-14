<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$configrator = get_post_meta( $post->ID, 'anpd_config_selector', true );
$colors = get_post_meta( $configrator, 'anpd_color_group', true );
$backings = get_post_meta( $configrator, 'anpd_backing_group', true );
$sizes = get_post_meta( $configrator, 'anpd_size_group', true );
$fonts = get_post_meta( $configrator, 'anpd_font_group', true );
$locations = get_post_meta( $configrator, 'anpd_location_group', true );
//$image_attributes = wp_get_attachment_image_src($field['locations_img'], 'full');
?>
<div class="anpd-container">
	<div class="anpd-row">
		<div class="anpd-editor anpd-col-8">
			<!-- <input type="text" name="Design" id="design" value="hello"> -->
			<textarea id="design">Hello</textarea>
		</div>
		<div class="anpd-col-options anpd-col-4">
			<form method="post" action="">
				<div class="anpd-option-card">
					<div class="col-anpd-label">
						<label for="locations"><?php _e('Location', 'advance-neon-product-designer'); ?></label>
					</div>
					<div class="col-anpd-options">
						<?php
						$i = 0; 
						foreach ($locations as $location) { 
							if($i == 0) { $checked = "checked";}else {$checked = '';}
							$image_attributes = wp_get_attachment_image_src($location['locations_img'], 'full');
						?>
						<label class="anpd-container-checkmark">
						  <input type="radio" name="location" value="<?php echo esc_attr($image_attributes[0]); ?>" <?php _e($checked,'advance-neon-product-designer'); ?>>
						  <span class="anpd-checkmark"><img src="<?php echo esc_attr($image_attributes[0]); ?>" ></span><?php _e($location['location_title'], 'advance-neon-product-designer'); ?>
						</label>
						<?php 
							$i++;
						} ?>
					</div>
				</div>
				<div class="anpd-option-card">
					<div class="col-anpd-label">
						<label for="locations"><?php _e('Color', 'advance-neon-product-designer'); ?></label>
					</div>
					<div class="col-anpd-options">
						<?php
						$i = 0; 
						foreach ($colors as $color) { 
							if($i == 0) { $checked = "checked";}else {$checked = '';}
						?>
						<label class="anpd-container-color">
						  <input type="radio" name="color" value="<?php _e($color['getcolor'],'advance-neon-product-designer') ?>" <?php _e($checked,'advance-neon-product-designer'); ?>>
						  <span class="anpd-color-checkmark" style="background-color: <?php _e($color['getcolor'],'advance-neon-product-designer') ?>"></span>
						</label>
						<?php 
							$i++;
						} ?>
					</div>
				</div>
				<div class="anpd-option-card">
					<div class="col-anpd-label">
						<label for="locations"><?php _e('Tube', 'advance-neon-product-designer'); ?></label>
					</div>
					<div class="col-anpd-options">
						<div class="anpd-row">
							<div class="anpd-col-6">
								<label class="tube-option anpd-first-tube">
									<input type="radio" name="tube" value="White">
									<div class="option-one"></div>
									<p><?php _e('White', 'advance-neon-product-designer'); ?></p>
								</label>
							</div>
							<div class="anpd-col-6">
								<label class="tube-option ">
									<input type="radio" name="tube" value="Color matching">
									<div class="option-two" style="background-color: <?php _e($colors[0]['getcolor'], 'advance-neon-product-designer'); ?>"></div>
									<p><?php _e('Color matching', 'advance-neon-product-designer'); ?></p>
								</label>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script type="text/javascript">
	jQuery('input[name=location]').change(function(){
	    var imageUrl = jQuery( 'input[name=location]:checked' ).val();
	    console.log(imageUrl);
	    jQuery('.anpd-editor').css('background-image', 'url(' + imageUrl + ')');
	});
	jQuery( function() {
		jQuery( "#design" ).draggable();
	})
</script>