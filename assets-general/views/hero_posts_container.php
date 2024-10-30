<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	$data_override_class = array();
	$data_override_style_var = array();

	/* ----------- */
	/* -- Class -- */
	/* ----------- */
	
	$class[] = 'hero-posts-container';
	
	/* ----------- */
	/* -- Style -- */
	/* ----------- */
	
	$array['accent_color'] = $array['accent_color'] != '' ? $array['accent_color'] : '#0693e3';
	$style[] = '--hero-posts-accent-color: ' . $array['accent_color'];	
	
	if ( substr( $array['accent_color'], 0, 3 ) === "rgb" ) { 
		$style[] = '--hero-products-accent-color-rgb: ' . $array['accent_color'];
	} else {
		$tmp = str_split( ltrim( $array['accent_color'], '#' ), 2 );
		$style[] = '--hero-products-accent-color-rgb: ' . hexdec( $tmp[0] ) . ', ' . hexdec( $tmp[1] ) . ', ' . hexdec( $tmp[2] );			
	}
	
	if ( $array['base_gap'] != '' ) $style[] = '--hero-posts-base-gap: ' . $array['base_gap'];	
	
	/* ------------ */
	/* -- Custom -- */
	/* ------------ */
	
	$class[] = $array['custom_class'];
	$style[] = trim( preg_replace( '/\s+/', ' ', $array['custom_style'] ));
	$id = $array['custom_id'];
	
	/* ------------ */
	/* -- Output -- */
	/* ------------ */
	
	$output = '';
	
	$output .= '<div class="' . esc_attr( implode( ' ', $class ) ) . '" style="' . esc_attr( implode( '; ', $style ) ) . '" id="' . esc_attr( $id ) . '" data-btbbl-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '" data-btbbl-override-style-var="' . htmlspecialchars( json_encode( $data_override_style_var, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '">';
	if (  isset( $array['content'] ) && is_array( $array['content'][0] ) ) {
		foreach( $array['content'] as $item ) {
			$output .= self::display( $item );
		}			
	}
	$output .= '</div>';
	
	return $output;
	
?>