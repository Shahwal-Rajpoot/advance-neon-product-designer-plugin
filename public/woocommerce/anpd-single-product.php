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
foreach ($fonts as $font) {
	$font_NU = urldecode($font['font']);
	$font_expload = explode("_x_",$font_NU);
	global $font_slug,$font_family;
	for ($x=0; $x < count($font_expload) ; $x++) { 
		if ($x==0) {
			$font_family = $font_expload[$x];
		}elseif ($x==1) {
			$font_slug = $font_expload[$x];
		}
	}
	$new_fonts[] = array(
		'font_family' => $font_family,
		'font_slug' =>  $font_slug,
		'font_price' => $font['font_price']
	);
}
?>
<style type="text/css">
<?php
foreach ($new_fonts as $font) {
	?>
	@font-face {
	  font-family: <?php echo $font["font_family"] ?>;
	  src: url('<?php echo $font["font_slug"] ?>');
	}
	
	<?php
}
?>
</style>
<?php
//For 1st location check
if (!empty($locations)) {
	$start_bg = wp_get_attachment_image_src($locations[0]['locations_img'], 'full');
	$attr_bg = esc_attr($start_bg[0]);
}else{
	$attr_bg = '';
}
//For 1st Font check
if (!empty($new_fonts)) {
	$first_font = $new_fonts[0]['font_family'];
}else{
	$first_font = 'None';
}
//For 1st Color check
if (!empty($colors)) {
	$first_colors = $colors[0]['getcolor'];
}else{
	$first_colors = '';
}
//print_r(explode('x', $sizes));
?>
<style type="text/css">
	div.product,.woocommerce-breadcrumb{
		display: none;
	}
	.woocommerce .wp-site-blocks>.wp-block-group{
	    max-width: 100%;
	    margin-left: auto;
	    margin-right: auto;
	    width: 100%;
	}
</style>
<div class="anpd-container">
	<h1 style="text-align: center;font-size: 30px;"><?php echo the_title(); ?></h1>
	<div class="anpd-row">
		<div class="anpd-editor anpd-col-8" style="--anpd9987:<?php echo $first_colors; ?>;background-image: linear-gradient(0deg, rgb(57, 57, 57) 0%, rgb(0 0 0 / 23%) 35%),url(<?php echo $attr_bg;  ?>)">
			<div class="editor_text" id="anpd_text_editor" style="color:var(--anpd9987);text-shadow:0 0 10px var(--anpd9987),0 0 21px var(--anpd9987),0 0 42px var(--anpd9987),0 0 62px var(--anpd9987),0 0 4px #fff"></div>
		</div>
		<div class="anpd-col-options anpd-col-4">
			<form method="post" action="">
				<div class="anpd-height-fixed">
					<div class="anpd-option-card">
						<div class="col-anpd-label">
							<label for="locations"><?php _e('Add Text Here', 'advance-neon-product-designer'); ?></label>
						</div>
						<div class="col-anpd-options">
							<textarea class="text-option" name="anpd_text" id="anpd_text">Hello</textarea>
						</div>
					</div>
					<div class="anpd-option-card">
						<div class="col-anpd-label">
							<label for="locations"><?php _e('Location', 'advance-neon-product-designer'); ?></label>
						</div>
						<div class="col-anpd-options">
							<?php
							if (!empty($locations)) {
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
								} 
							}else{
								_e('Please add product Background Locations', 'advance-neon-product-designer');
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
									<button class="andp-font-button"><span class="anpd-font-name"><?php _e($first_font,'advance-neon-product-designer'); ?></span><span class="anpd-arrow"></span></button>
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
							<div class="font-options" style="display: none;">
								<?php
								if (!empty($new_fonts)) {
									$i = 0; 
									foreach ($new_fonts as $font) { 
										if($i == 0) { $checked = "checked"; $highlight_font = "anpd-font-highlight";}else {$checked = '';$highlight_font = '';}
									?>
										<label style="font-family: <?php echo $font['font_family'] ?>" class="anpd-font-label <?php _e($highlight_font,'advance-neon-product-designer'); ?>">
											<input slug="<?php _e($font['font_slug'], 'advance-neon-product-designer'); ?>" type="radio" name="font" value="<?php _e($font['font_family'],'advance-neon-product-designer'); ?>" <?php _e($checked,'advance-neon-product-designer'); ?>>
											<div class="option-one"></div>
											<?php _e($font['font_family'], 'advance-neon-product-designer'); ?>
										</label>
									<?php 
										$i++;
									} 
								}else{
									_e('Please Add Fonts For This Product', 'advance-neon-product-designer');
								} ?>
							</div>
						</div>
					</div>
					<div class="anpd-option-card">
						<div class="col-anpd-label">
							<label for="locations"><?php _e('Color', 'advance-neon-product-designer'); ?></label>
						</div>
						<div class="col-anpd-options">
							<?php
							if (!empty($colors)) {
								$i = 0; 
								foreach ($colors as $color) { 
									if($i == 0) { $checked = "checked";}else {$checked = '';}
									// $font_NU = urldecode($font['font']);
									// $font_expload = explode("_x_",$font_NU);
									// for ($x=0; $x < count($font_expload) ; $x++) { 
									// 	if ($x==0) {
									// 		$font_family = $font_expload[$x];
									// 	}elseif ($x==1) {
									// 		$font_slug = $font_expload[$x];
									// 	}
									// }
								?>
								<label class="anpd-container-color">
								  <input type="radio" name="color" value="<?php _e($color['getcolor'],'advance-neon-product-designer') ?>" <?php _e($checked,'advance-neon-product-designer'); ?>>
								  <span class="anpd-color-checkmark" style="background-color: <?php _e($color['getcolor'],'advance-neon-product-designer') ?>"></span>
								</label>
								<?php 
									$i++;
								} 
							}else{
								_e('Please Add Colors For This Product', 'advance-neon-product-designer');
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
									<label class="tube-option anpd-highlight">
										<input type="radio" name="tube" value="White" checked>
										<div class="option-one"></div>
										<p><?php _e('White', 'advance-neon-product-designer'); ?></p>
									</label>
								</div>
								<div class="anpd-col-6">
									<label class="tube-option">
										<input type="radio" name="tube" value="Color matching">
										<div class="option-two" style="background-color: <?php _e($first_colors, 'advance-neon-product-designer'); ?>"></div>
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
							if (!empty($sizes)) {
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
								} 
							}else{
								_e('Please Add Sizes For This Product', 'advance-neon-product-designer');
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
								if (!empty($backings)) {
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
									}
								}else{
									_e('Please Add Sizes For This Product', 'advance-neon-product-designer');
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