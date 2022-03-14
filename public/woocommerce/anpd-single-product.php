<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$configrator = get_post_meta( $post->ID, 'anpd_config_selector', true );
echo 'colors<br>';
$colors = get_post_meta( $configrator, 'anpd_color_group', true );
print_r($colors);
echo '<br><br><br>';
echo 'backing<br>';
$backing = get_post_meta( $configrator, 'anpd_backing_group', true );
print_r($backing);
echo '<br><br><br>';
echo 'size<br>';
$size = get_post_meta( $configrator, 'anpd_size_group', true );
print_r($size);
echo '<br><br><br>';
echo 'font<br>';
$font = get_post_meta( $configrator, 'anpd_font_group', true );
print_r($font);
echo '<br><br><br>';
echo 'location<br>';
$location = get_post_meta( $configrator, 'anpd_location_group', true );
print_r($location);
echo '<br><br><br>';
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
	<div class="anpd-d-flex">
		<div class="anpd-editor anpd-col-8">
			
		</div>
		<div class="anpd-col-options anpd-col-4">
			<form method="post" action="">
				<div class="anpd-location-row">
					<div class="col-anpd-label">
						<label for="locations">Location</label>
					</div>
					<div class="col-anpd-options">
						
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
