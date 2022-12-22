<?php
if( !defined( 'ABSPATH' ) ) {
	wp_die( esc_attr( 'This script cannot be accessed directly.' ) );
}

/**
 * Output element's form textarea field
 *
 * @var $name string Form's field name
 * @var $id string Form's field ID
 * @var $value string Current value
 */

$output = '<textarea name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '">';
$output .= esc_textarea( $value );
$output .= '</textarea>';

printf( esc_attr( $output ) );
