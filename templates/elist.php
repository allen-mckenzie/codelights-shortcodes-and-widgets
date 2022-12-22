<?php
if( !defined( 'ABSPATH' ) ) {
	wp_die( esc_attr( 'This script cannot be accessed directly.' ) );
}

/**
 * Output elements list to choose from
 */

global $cl_uri;
$elements = cl_config( 'elements', array() );

$output = '<div class="cl-elist"><div class="cl-elist-h">';
$output .= '<h2 class="cl-elist-title">' . __( 'Insert shortcode', 'codelights-shortcodes-and-widgets' ) . '</h2>';
$output .= '<div class="cl-elist-closer">&times;</div>';
$output .= '<ul class="cl-elist-list">';
foreach ( $elements as $name => $elm ) {
	$output .= '<li class="cl-elist-item for_' . $name . '" data-name="' . $name . '"><div class="cl-elist-item-h">';
	$output .= '<div class="cl-elist-item-icon"';
	if ( isset( $elm['icon'] ) AND ! empty( $elm['icon'] ) ) {
		$output .= ' style="background-image: url(' . $elm['icon'] . ')';
	}
	$output .= '"></div>';
	$output .= '<div class="cl-elist-item-title">' . ( isset( $elm['title'] ) ? $elm['title'] : $name ) . '</div>';
	if ( isset( $elm['description'] ) AND ! empty( $elm['description'] ) ) {
		$output .= '<div class="cl-elist-item-description">' . $elm['description'] . '</div>';
	}
	$output .= '</div></li>';
}
$output .= '</ul></div></div>';

$output .= '</div>';
$allow_html = wp_kses_allowed_html( 'post' );
$allow_protocols = wp_allowed_protocols();
print( wp_kses( $output, $allow_html, $allow_protocols ) );

