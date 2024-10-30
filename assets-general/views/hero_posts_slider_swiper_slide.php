<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		
	$data_override_class = array();
	$data_override_style_var = array();
	
	/* ----------- */
	/* -- Class -- */
	/* ----------- */
	
	$class[] = 'swiper-slide';
	$class[] = 'hero-posts-slider-swiper-slide';
	
	/* ----------- */
	/* -- Style -- */
	/* ----------- */
	
	
	/* ------------ */
	/* -- Custom -- */
	/* ------------ */
	
	$class[] = $array['custom_class'];
	$style[] = trim( preg_replace( '/\s+/', ' ', $array['custom_style'] ));
	// $id = $array['custom_id'] != '' ? $array['custom_id'] : uniqid( 'hero-posts-slider-swiper-slide-' );
	$id = $array['custom_id'];
	
	/* ------------ */
	/* -- Output -- */
	/* ------------ */
	
	$output = '';
	
	$output .= '<div class="' . esc_attr( implode( ' ', $class ) ) . '" style="' . esc_attr( implode( '; ', $style ) ) . '" id="' . esc_attr( $id ) . '" data-btbbl-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '" data-btbbl-override-style-var="' . htmlspecialchars( json_encode( $data_override_style_var, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '"/>';
		
	if (  isset( $array['content'] ) && is_array( $array['content'][0] ) ) {
		foreach( $array['content'] as $item ) {
			$output .= self::display( $item );
		}			
	}
	$output .= '</div>';
	
	return $output;