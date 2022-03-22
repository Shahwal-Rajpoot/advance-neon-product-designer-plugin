<?php
global $post;
$anpd_color_group = get_post_meta($post->ID, 'anpd_color_group', true);
wp_nonce_field( 'repeterBox-colors', 'anpd-colors' );
?>

<table class="anpd-table" id="repeatable-fieldset-one" width="100%">
	<thead>
		<tr>
			<th>Title</th>
			<th>Color</th>
			<th>Color Price</th>
			<th>Remove</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ( $anpd_color_group ) :
			foreach ( $anpd_color_group as $field ) {
				?>
				<tr>
					<td><input type="text"  style="width:98%;" name="title[]" value="<?php if($field['title'] != '') echo esc_attr( $field['title'] ); ?>" placeholder="Title" /></td>
					<td><input class="getColor" type="color"  style="width:15%;" name="getcolor[]" value="<?php if ($field['getcolor'] != '') echo esc_attr( $field['getcolor'] ); ?>" /><input type="text" name="outputcolor[]" class="outputcolor" style="width:82%;" value="<?php if ($field['outputcolor'] != '') echo esc_attr( $field['outputcolor'] ); ?>"></td>
					<td><input type="number" style="width:98%;" name="price[]" value="<?php if ($field['price'] != '') echo esc_attr( $field['price'] ); ?>" placeholder="Price" min="0" step="0.01"/></td>
					<td style="text-align: center;"><a class="button remove-row" href="#1">Remove</a></td>
				</tr>
				<?php
			}
		else :
			?>
			<tr>
				<td><input type="text" style="width:98%;" name="title[]" placeholder="Title"/></td>
				<td><input class="getColor" type="color"  style="width:15%;" name="getcolor[]" /><input type="text" name="outputcolor[]" class="outputcolor" style="width:82%;"></td>
				<td><input type="number" style="width:98%;" name="price[]" placeholder="Price" min="0" step="0.01"/></td>
				<td style="text-align: center;"><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
			</tr>
		<?php endif; ?>
		<tr class="empty-row custom-repeter-text" style="display: none">
			<td><input type="text" style="width:98%;" name="title[]" placeholder="Title"/></td>
			<td><input class="getColor" type="color" style="width:15%;" name="getcolor[]" /><input type="text" name="outputcolor[]" class="outputcolor" style="width:82%;"></td>
			<td><input type="number" style="width:98%;" name="price[]" placeholder="Price" min="0" step="0.01"/></td>
			<td style="text-align: center;"><a class="button remove-row" href="#">Remove</a></td>
		</tr>
		
	</tbody>
</table>
<hr>
<p><a id="add-row" class="button add-row" href="#">Add another</a></p>