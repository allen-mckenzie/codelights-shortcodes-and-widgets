<?php
if( !defined( 'ABSPATH' ) ) {
	wp_die( esc_attr( 'This script cannot be accessed directly.' ) );
}

/**
 * Output elements builder
 *
 * @var $titles array Elements titles
 * @var $body string Body inner HTML
 */
$titles = ( isset( $titles ) AND is_array( $titles ) ) ? $titles : array();
$body = isset( $body ) ? $body : '';

?>
<div class="cl-ebuilder">
	<div class="cl-ebuilder-header">
		<div class="cl-ebuilder-title"<?php print( cl_pass_data_to_js($titles) ); ?>></div>
		<div class="cl-ebuilder-closer">&times;</div>
	</div>
	<div class="cl-ebuilder-body"><?php print( $body ); ?></div>
	<div class="cl-ebuilder-footer">
		<div class="cl-ebuilder-btn for_close button"><?php esc_attr_e( 'Close', 'codelights-shortcodes-and-widgets' ) ?></div>
		<div class="cl-ebuilder-btn for_save button button-primary"><?php esc_attr_e( 'Save changes', 'codelights-shortcodes-and-widgets' ) ?></div>
	</div>
</div>
