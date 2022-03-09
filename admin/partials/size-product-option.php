<?php
global $post;
$anpd_size_group = get_post_meta($post->ID, 'anpd_size_group', true);
wp_nonce_field( 'repeterBox-sizes', 'anpd-sizes' );
?>

<table class="anpd-table" id="repeatable-fieldset-one" width="100%">
	<thead>
		<tr>
			<th>size</th>
			<th>size Price</th>
			<th>Remove</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ( $anpd_size_group ) :
			foreach ( $anpd_size_group as $field ) {
				?>
				<tr>
					<td><input type="text"  style="width:98%;" name="size_title[]" value="<?php if($field['size_title'] != '') echo esc_attr( $field['size_title'] ); ?>" placeholder="100x50" /></td>
					<td><input type="number" style="width:98%;" name="size_price[]" value="<?php if ($field['size_price'] != '') echo esc_attr( $field['size_price'] ); ?>" placeholder="Price"/></td>
					<td style="text-align: center;"><a class="button remove-row" href="#1">Remove</a></td>
				</tr>
				<?php
			}
		else :
			?>
			<tr>
				<td><input type="text" style="width:98%;" name="size_title[]" placeholder="100x50"/></td>
				<td><input type="number" style="width:98%;" name="size_price[]" placeholder="Price"/></td>
				<td style="text-align: center;"><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
			</tr>
		<?php endif; ?>
		<tr class="empty-row custom-repeter-text" style="display: none">
			<td><input type="text" style="width:98%;" name="size_title[]" placeholder="100x50"/></td>
			<td><input type="number" style="width:98%;" name="size_price[]" placeholder="Price"/></td>
			<td style="text-align: center;"><a class="button remove-row" href="#">Remove</a></td>
		</tr>
		
	</tbody>
</table>
<p><a id="add-row" class="button add-row" href="#">Add another</a></p>