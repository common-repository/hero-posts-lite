<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	$data_override_class = array();
	$data_override_style_var = array();
	
	/* ----------- */
	/* -- Class -- */
	/* ----------- */
	
	$class[] = 'hero-posts-banner';
	
	/* ----------- */
	/* -- Style -- */
	/* ----------- */
	
	$style[] = '--hero-posts-banner-border-style: ' . $array['border_style'];	
	$style[] = '--hero-posts-banner-border-width: ' . $array['border_width'];	
	if( $array['border_color'] != '' ) $style[] = '--hero-posts-banner-border-color: ' . $array['border_color'];	
	
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

	$output .= '<div class="' . esc_attr( implode( ' ', $class ) ) . '" style="' . esc_attr( implode( '; ', $style ) ) . '" id="' . esc_attr( $id ) . '" data-btbbl-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '" data-btbbl-override-style-var="' . htmlspecialchars( json_encode( $data_override_style_var, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '"/>';
	if ( function_exists( 'hero_posts_decode' ) ) $output .= hero_posts_decode( $array['code'] );
	$output .= '</div>';
	
	return $output;