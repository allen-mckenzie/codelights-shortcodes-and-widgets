<?php
if( !defined( 'ABSPATH' ) ) {
	wp_die( esc_attr( 'This script cannot be accessed directly.' ) );
}

/**
 * Output element's form textfield field
 *
 * @var $name string Form's field name
 * @var $id string Form's field ID
 * @var $value string Current value
 */

$output = '<input type="text" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '"';
$output .= ' value="' . esc_attr( $value ) . '" />';

$output .= '</div>';
$allow_html = wp_kses_allowed_html( 'post' );
$allow_protocols = wp_allowed_protocols();
print( wp_kses( $output, $allow_html, $allow_protocols ) );
