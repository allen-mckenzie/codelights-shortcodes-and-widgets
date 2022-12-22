<?php
if( !defined( 'ABSPATH' ) ) {
	wp_die( esc_attr( 'This script cannot be accessed directly.' ) );
}

/**
 * Output element's form checkboxes field
 *
 * @var $name string Form's field name
 * @var $id string Form's field ID
 * @var $value string Current value
 * @var $options array List of value => title options
 */
if ( ! isset( $options ) OR empty( $options ) ) {
	$options = array( 'yes' => __( 'Yes', 'codelights-shortcodes-and-widgets' ) );
}

$values = explode( ',', $value );

$output = '';

foreach ( $options as $option => $title ) {
	$output .= '<label class="cl-checkbox">';
	$output .= '<input type="checkbox" value="' . esc_attr( $option ) . '"';
	if ( in_array( $option, $values ) ) {
		$output .= ' checked="checked"';
	}
	$output .= ' /> ' . $title . '</label>';
}
$output .= '<input type="hidden" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" />';

$output .= '</div>';
$allow_html = wp_kses_allowed_html( 'post' );
$allow_protocols = wp_allowed_protocols();
print( wp_kses( $output, $allow_html, $allow_protocols ) );
