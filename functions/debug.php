<?php
if( !defined( 'ABSPATH' ) ) {
	wp_die( esc_attr( 'This script cannot be accessed directly.' ) );
}

/**
 * Enable Debugger to use Error Log
 */
if ( ! function_exists('write_log')) {
	function write_log ( $log )  {
	   if ( is_array( esc_attr_e( $log ) ) || is_object( esc_attr_e( $log ) ) ) {
		  error_log( print_r( esc_attr_e( $log ), true ) );
	   } else {
		  error_log( esc_attr_e( $log ) );
	   }
	}
 }

function cl_write_debug( $value, $with_backtrace = FALSE ) {
	global $cl_dir;
	static $first = TRUE;
	$data = '';
	if ( $with_backtrace ) {
		$backtrace = debug_backtrace();
		array_shift( $backtrace );
		$data .= print_r( $backtrace, TRUE ) . ":\n";
	}
	ob_start();
	var_dump( $value );
	$data .= ob_get_clean() . "\n\n";
	// file_put_contents( $cl_dir . 'debug.txt', $data, $first ? NULL : FILE_APPEND );
	write_log( esc_attr_e( $data ) );
	$first = FALSE;
}
