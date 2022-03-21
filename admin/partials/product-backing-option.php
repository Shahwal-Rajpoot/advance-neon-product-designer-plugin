<?php
global $post;
$anpd_backing_group = get_post_meta($post->ID, 'anpd_backing_group', true);
wp_nonce_field( 'repeterBox-backings', 'anpd-backings' );
?>

<table class="anpd-table" id="repeatable-fieldset-one" width="100%">
	<thead>
		<tr>
			<th>Backing</th>
			<th>Backing Price</th>
			<th>Remove</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ( $anpd_backing_group ) :
			foreach ( $anpd_backing_group as $field ) {
				?>
				<tr>
					<td><input type="text"  style="width:98%;" name="backing_title[]" value="<?php if($field['backing_title'] != '') echo esc_attr( $field['backing_title'] ); ?>" placeholder="Title" /></td>
					<td><input type="number" style="width:98%;" name="backing_price[]" value="<?php if ($field['backing_price'] != '') echo esc_attr( $field['backing_price'] ); ?>" placeholder="Price" min="0.01" step="0.01" /></td>
					<td style="text-align: center;"><a class="button remove-row" href="#1">Remove</a></td>
				</tr>
				<?php
			}
		else :
			?>
			<tr>
				<td><input type="text" style="width:98%;" name="backing_title[]" placeholder="Title"/></td>
				<td><input type="number" style="width:98%;" name="backing_price[]" placeholder="Price" min="0.01" step="0.01"/></td>
				<td style="text-align: center;"><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
			</tr>
		<?php endif; ?>
		<tr class="empty-row custom-repeter-text" style="display: none">
			<td><input type="text" style="width:98%;" name="backing_title[]" placeholder="Title"/></td>
			<td><input type="number" style="width:98%;" name="backing_price[]" placeholder="Price" min="0.01" step="0.01"/></td>
			<td style="text-align: center;"><a class="button remove-row" href="#">Remove</a></td>
		</tr>
		
	</tbody>
</table>
<hr>
<p><a id="add-row" class="button add-row" href="#">Add another</a></p>