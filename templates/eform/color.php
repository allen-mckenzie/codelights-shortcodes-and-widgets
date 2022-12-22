<?php
if( !defined( 'ABSPATH' ) ) {
	wp_die( esc_attr( 'This script cannot be accessed directly.' ) );
}

/**
 * Output element's form color field
 *
 * @var $name string Form's field name
 * @var $id string Form's field ID
 * @var $value string Current value
 */

wp_enqueue_style( 'wp-color-picker' );
wp_enqueue_script( 'wp-color-picker-alpha' );

$output = '<input id="' . esc_attr( $id ) . '" type="text" data-default-color="' . esc_attr( $value ) . '" data-alpha="true" name="' . esc_attr( $name ) . '" class="cl-color-picker" value="' . esc_attr( $value ) . '"/>';

$output .= '</div>';
$allow_html = wp_kses_allowed_html( 'post' );
$allow_protocols = wp_allowed_protocols();
print( wp_kses( $output, $allow_html, $allow_protocols ) );
