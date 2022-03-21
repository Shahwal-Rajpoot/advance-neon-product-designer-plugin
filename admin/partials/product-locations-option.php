<?php
global $post;
$anpd_location_group = get_post_meta($post->ID, 'anpd_location_group', true);
wp_nonce_field( 'repeterBox-locations', 'anpd-locations' );
?>

<table class="anpd-table anpd-locations-table" id="repeatable-fieldset-one" width="100%">
	<thead>
		<tr>
			<th>location Media</th>
			<th>location</th>
			<th>location Price</th>
			<th>Remove</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ( $anpd_location_group ) :
			foreach ( $anpd_location_group as $field ) {
				?>
				<tr>
					<td>
						<?php 
							$image_attributes = wp_get_attachment_image_src($field['locations_img'], 'full');
						?>
						<div class="anpd-img">
							<a href="<?php echo esc_attr($image_attributes[0]); ?>" target="_blank"><img class="true_pre_image" src="<?php echo esc_attr($image_attributes[0]); ?>" /></a>
							
						</div>
						<a href="#" class="wc_multi_upload_image_button button">Update Media</a>
						<input type="hidden" class="attechments-ids" name="locations_img[]" value="<?php echo esc_attr($field['locations_img']); ?>" />
					</td>
					<td>
						<input type="text"  style="width:98%;" name="location_title[]" value="<?php if($field['location_title'] != '') echo esc_attr( $field['location_title'] ); ?>" placeholder="Title" />
					</td>
					<td>
						<input type="number" style="width:98%;" name="location_price[]" value="<?php if ($field['location_price'] != '') echo esc_attr( $field['location_price'] ); ?>" placeholder="Location Price" min="0.01" step="0.01"/>
					</td>
					<td style="text-align: center;">
						<a class="button remove-row" href="#1">Remove</a>
					</td>
				</tr>
				<?php
			}
		else :
			?>
			<tr>
				<td>
					<div class="anpd-img">
						<a href="" target="_blank"><img class="true_pre_image" src="" /></a>
					</div>
					<a href="#" class="wc_multi_upload_image_button button">Add Media</a>
					<a href="#" class="wc_multi_remove_image_button button" style="display: none;">Remove media</a>
					<input type="hidden" class="attechments-ids" name="locations_img[]" />
				</td>
				<td><input type="text" style="width:98%;" name="location_title[]" placeholder="Location Title"/></td>
				<td><input type="number" style="width:98%;" name="location_price[]" placeholder="Location Price" min="0.01" step="0.01"/></td>
				<td style="text-align: center;"><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
			</tr>
		<?php endif; ?>
		<tr class="empty-row custom-repeter-text" style="display: none">
			<td>
				<div class="anpd-img">
					<a href="" target="_blank"><img class="true_pre_image" src="" /></a>
				</div>
				<a href="#" class="wc_multi_upload_image_button button">Add Media</a>
				<a href="#" class="wc_multi_remove_image_button button" style="display: none;">Remove media</a>
				<input type="hidden" class="attechments-ids" name="locations_img[]" />
			</td>
			<td><input type="text" style="width:98%;" name="location_title[]" placeholder="Location Title"/></td>
			<td><input type="number" style="width:98%;" name="location_price[]" placeholder="Price" min="0.01" step="0.01"/></td>
			<td style="text-align: center;"><a class="button remove-row" href="#">Remove</a></td>
		</tr>
		
	</tbody>
</table>
<hr>
<p><a id="add-row" class="button add-row" href="#">Add another</a></p>