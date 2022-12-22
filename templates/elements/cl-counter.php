<?php
if( !defined( 'ABSPATH' ) ) {
	wp_die( esc_attr( 'This script cannot be accessed directly.' ) );
}

/**
 * Output a single flipbox element.
 *
 * @var $initial string The initial string
 * @var $final string The final string
 * @var $duration string Animation duration: '100ms' / '200ms' / ... / '1200ms'
 * @var $animation string Digits animation type: 'none' / 'slideup' / 'slidedown'
 * @var $title string
 * @var $value_size string Font size
 * @var $title_size string Title size
 * @var $value_color string Value color
 * @var $title_color string Title color
 * @var $el_class string Extra class name
 */

// Enqueuing the needed assets
wp_enqueue_style( 'cl-counter' );
wp_enqueue_script( 'cl-counter' );

// Element classes and attributes
$classes = '';
$atts = '';

if ( ! empty( $duration ) ) {
	$atts .= ' data-duration=' . $duration;
}

// Finding numbers positions in both initial and final strings
$pos = array();
foreach ( array( 'initial', 'final' ) as $key ) {
	$pos[ $key ] = array();
	// In this array we'll store the string's character number, where primitive changes from letter to number or back
	preg_match_all( '~(\(\-?\d+([\.,\'· ]\d+)*\))|(\-?\d+([\.,\'· ]\d+)*)~u', $$key, $matches, PREG_OFFSET_CAPTURE );
	foreach ( $matches[0] as $match ) {
		$pos[ $key ][] = $match[1];
		$pos[ $key ][] = $match[1] + strlen( $match[0] );
	}
};

// Making sure we have the equal number of numbers in both strings
if ( count( $pos['initial'] ) != count( $pos['final'] ) ) {
	// Not-paired numbers will be treated as letters
	if ( count( $pos['initial'] ) > count( $pos['final'] ) ) {
		$pos['initial'] = array_slice( $pos['initial'], 0, count( $pos['final'] ) );
	} else/*if ( count( $positions['initial'] ) < count( $positions['final'] ) )*/ {
		$pos['final'] = array_slice( $pos['final'], 0, count( $pos['initial'] ) );
	}
}

// Position boundaries
foreach ( array( 'initial', 'final' ) as $key ) {
	array_unshift( $pos[ $key ], 0 );
	$pos[ $key ][] = strlen( $$key );
}

if ( ! empty( $el_class ) ) {
	$classes .= ' ' . $el_class;
}
$output = '';
ob_start();
?>
<div class="cl-counter<?php print( esc_attr_e( $classes ) ); ?>" <?php print( esc_attr_e( $atts ) ); ?> >
<div class="cl-counter-value"
<?php
$inline_css = cl_prepare_inline_css( array(
	'color' => $value_color,
	'font-size' => $value_size,
) );
print( esc_attr_e( $inline_css ) );
?>
>
<?php

// Determining if we treat each part as a number or as a letter combination
for ( $index = 0, $length = count( $pos['initial'] ) - 1; $index < $length; $index++ ) {
	$part_type = ( $index % 2 ) ? 'number' : 'text';
	$part_initial = substr( $initial, $pos['initial'][ $index ], $pos['initial'][ $index + 1 ] - $pos['initial'][ $index ] );
	$part_final = substr( $final, $pos['final'][ $index ], $pos['final'][ $index + 1 ] - $pos['final'][ $index ] );
	?>
		<span class="cl-counter-value-part type_<?php print( esc_attr_e( $part_type ) ); ?>" data-final="<?php print( esc_attr_e( $part_final ) ); ?>"><?php print( esc_attr_e( $part_initial ) ); ?></span>
	<?php
}
?>
</div>
<?php
if ( ! empty( $title ) ) {
	$counter_content = cl_prepare_inline_css( array(
		'color' => $title_color,
		'font-size' => $title_size,
	) );
	?>
		<div class="cl-counter-title" <?php print( esc_attr_e( $counter_content ) ); ?>><?php print( esc_attr_e( $title ) ); ?> </div>
	<?php
}
?>
</div>
<?php
$allow_html = array(
	'div' => array(
		'class' => array(),
		'data-duration' => array(),
		'style' => array()
	),
	'img' => array(
		'title' => array(),
		'src'	=> array(),
		'alt'	=> array(),
	),
	'span' => array(
		'class' => array(),
		'data-final' => array()
	)
);
$allow_protocols = array(
	'data' 	=> array(),
	'http'	=> array(),
	'https' => array()
);
$output = ob_get_contents();
ob_end_clean();
print wp_kses( $output, $allow_html, $allow_protocols );
