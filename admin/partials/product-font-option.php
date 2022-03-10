<?php
global $post,$url_decode;
$anpd_font_group = get_post_meta($post->ID, 'anpd_font_group', true);
wp_nonce_field( 'repeterBox-fonts', 'anpd-fonts' );

$url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBwjhzcfEEHD0cL0S90wDyvoKHLGJdwWvY';
$wp_nonce_url = wp_nonce_url( $url );
$test_url     = request_filesystem_credentials( $wp_nonce_url, '', false, false, null );

if ( $test_url ) {
	$url        = wp_remote_get( $url, array( 'timeout' => 120 ) );
	$url_decode = '';
	if ( is_array( $url ) ) {
		$url_decode = json_decode( $url['body'], true );
	}
} else {
	$url = wp_remote_get( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/js/google-fonts.json', array( 'timeout' => 120 ) );
	$url_decode = '';
	if ( is_array( $url ) ) {
		$url_decode = json_decode( $url['body'], true );
	}
}

function font_options($selected_font){
	global $url_decode;
	echo '<option value="">' . __( 'Pick a google font', 'anpd-neon-product-designer' ) . ' </option>';
	foreach ( $url_decode['items'] as $font ) {
		if ( isset( $font['family'] ) && isset( $font['files'] ) && isset( $font['files']['regular'] ) ) {
			$selected = '';
			if ( $selected_font === $font['family'] ) {
				$selected = 'selected';
			}
			echo '<option value="' . rawurlencode( esc_attr($font['family']) ) . '" ' . esc_attr($selected) . '>' . esc_attr($font['family']) . '</option> ';
		}
	}
}
?>
<table class="anpd-table" id="repeatable-fieldset-one" width="100%">
	<thead>
		<tr>
			<th>font</th>
			<th>font Price</th>
			<th>Remove</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ( $anpd_font_group ) :
			foreach ( $anpd_font_group as $field ) {
				?>
				<tr>
					<td>
						<?php 
							$font_selected = urldecode($field['font']);
						?>
						<select style="width:98%;" class="form-control anpd-font-select" name="font[]">

						  	<?php
								font_options($font_selected);
							?>
						</select>
					</td>
					<td><input type="number" style="width:98%;" name="font_price[]" value="<?php if ($field['font_price'] != '') echo esc_attr( $field['font_price'] ); ?>" placeholder="Price"/></td>
					<td style="text-align: center;"><a class="button remove-row" href="#1">Remove</a></td>
				</tr>
				<?php
			}
		else :
			?>
			<tr>
				<td>
					<select style="width:98%;" class="form-control anpd-font-select" name="font[]">
						<?php
						  	$font_not_selected = '';
							font_options($font_not_selected);
						?>
					</select>
				</td>
				<td><input type="number" style="width:98%;" name="font_price[]" placeholder="Price"/></td>
				<td style="text-align: center;"><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
			</tr>
		<?php endif; ?>
		<tr class="empty-row custom-repeter-text" style="display: none">
			<td>
				<select style="width:98%;" class="form-control font-options" name="font[]">
					<?php
					$font_not_selected = '';
						font_options($font_not_selected);
					?>
				</select>
			</td>
			<td><input  type="number" style="width:98%;" name="font_price[]" placeholder="Price"/></td>
			<td style="text-align: center;"><a class="button remove-row" href="#">Remove</a></td>
		</tr>
		
	</tbody>
</table>
<hr>
<p><a id="add-row" class="button add-row" href="#">Add another</a></p>