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
				<div class="anpd-height-fixed">
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
							<label for="locations"><?php _e('FONT', 'advance-neon-product-designer'); ?></label>
						</div>
						<div class="col-anpd-options">
							<div class="anpd-row">
								<div class="anpd-col-6">
								</div>
								<div class="anpd-col-6">
									<label class="anpd-alignment-label">
										<input type="radio" name="alignment" value="Left">
										<div class="anpd-bar anpd-bar-80"></div>
										<div class="anpd-bar anpd-bar-40"></div>
										<div class="anpd-bar anpd-bar-60"></div>
										<div class="anpd-bar anpd-bar-80"></div>
									</label>
									<label class="anpd-alignment-label anpd-center-label anpd-alignment-highlight">
										<input type="radio" name="alignment" value="Center" checked>
										<div class="anpd-bar anpd-bar-80"></div>
										<div class="anpd-bar anpd-bar-40"></div>
										<div class="anpd-bar anpd-bar-60"></div>
										<div class="anpd-bar anpd-bar-80"></div>
									</label>
									<label class="anpd-alignment-label anpd-right-label">
										<input type="radio" name="alignment" value="Right">
										<div class="anpd-bar anpd-bar-80"></div>
										<div class="anpd-bar anpd-bar-40"></div>
										<div class="anpd-bar anpd-bar-60"></div>
										<div class="anpd-bar anpd-bar-80"></div>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="anpd-option-card">
						<div class="col-anpd-label">
							<label for="locations"><?php _e('Tube', 'advance-neon-product-designer'); ?></label>
						</div>
						<div class="col-anpd-options">
							<div class="anpd-row">
								<div class="anpd-col-6">
									<label class="tube-option anpd-highlight">
										<input type="radio" name="tube" value="White" checked>
										<div class="option-one"></div>
										<p><?php _e('White', 'advance-neon-product-designer'); ?></p>
									</label>
								</div>
								<div class="anpd-col-6">
									<label class="tube-option">
										<input type="radio" name="tube" value="Color matching">
										<div class="option-two" style="background-color: <?php _e($colors[0]['getcolor'], 'advance-neon-product-designer'); ?>"></div>
										<p><?php _e('Color matching', 'advance-neon-product-designer'); ?></p>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="anpd-option-card">
						<div class="col-anpd-label">
							<label for="locations"><?php _e('Size', 'advance-neon-product-designer'); ?></label>
						</div>
						<div class="col-anpd-options">
							<?php
							$i = 0; 
							foreach ($sizes as $size) { 
								if($i == 0) { $checked = "checked"; $highlight_size = "anpd-size-highlight";}else {$checked = '';$highlight_size = '';}
							?>
								<label class="anpd-size-label <?php _e($highlight_size,'advance-neon-product-designer'); ?>">
									<input type="radio" name="size" value="<?php _e($size['size_title'],'advance-neon-product-designer'); ?>" <?php _e($checked,'advance-neon-product-designer'); ?>>
									<div class="option-one"></div>
									<?php _e($size['size_title'], 'advance-neon-product-designer'); ?>
								</label>
							<?php 
								$i++;
							} ?>
						</div>
					</div>
					<div class="anpd-option-card">
						<div class="col-anpd-label">
							<label for="locations"><?php _e('BACKING', 'advance-neon-product-designer'); ?></label>
						</div>
						<div class="col-anpd-options">
							<div class="anpd-row">
								<?php
								$i = 0; 
								foreach ($backings as $backing) { 
									if($i == 0) { $checked = "checked"; $highlight_backing = "anpd-backing-highlight";}else {$checked = '';$highlight_backing = '';}
								?>
								<div class="anpd-col-6">
									<label class="anpd-backing-label <?php _e($highlight_backing,'advance-neon-product-designer'); ?>">
										<input type="radio" name="backing" value="<?php _e($backing['backing_title'],'advance-neon-product-designer'); ?>" <?php _e($checked,'advance-neon-product-designer'); ?>>
										<div class="option-one"></div>
										<?php _e($backing['backing_title'], 'advance-neon-product-designer'); ?>
									</label>
								</div>
								<?php 
									$i++;
								} ?>
							</div>
						</div>
					</div>
				</div>
				<input type="submit" name="submit" value="DONE" class="anpd-product-submit">
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
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

  	jQuery('input[name=color]').change(function() {
	    color = jQuery(this).val();
	    jQuery('.option-two').css('background-color', color);
  	});
</script>