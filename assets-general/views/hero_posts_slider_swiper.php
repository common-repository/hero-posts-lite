<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		
	$data_override_class = array();
	$data_override_style_var = array();
	
	/* ----------- */
	/* -- Class -- */
	/* ----------- */
	
	// $class[] = 'swiper';
	$class[] = 'hero-posts-slider-swiper';	
	
	$class[] = 'hero-posts-slider-swiper-navigation-style-' . $array['navigation'];	
	$class[] = 'hero-posts-slider-swiper-navigation-size-' . $array['navigation_size'];
	$class[] = 'hero-posts-slider-swiper-navigation-vertical-position-' . $array['navigation_vertical_position'];
	
	$class[] = 'hero-posts-slider-swiper-pagination-style-' . $array['pagination'];
	$class[] = 'hero-posts-slider-swiper-pagination-size-' . $array['pagination_size'];
	
	// $class[] = 'hero-posts-slider-swiper-navigation-position-' . $array['navigation_position'];
	BTBB_Light::responsive_data_override_class(
		$class, $data_override_class,
		array(
			'prefix' => 'hero-posts-slider-swiper-navigation-',
			'suffix' => '-',
			'param' =>  'position',
			'value' =>  $array['navigation_position']
		)
	);
	
	/* ----------- */
	/* -- Style -- */
	/* ----------- */
	
	if ( $array['space_between'] != 'inherit' ) $style[] = '--hero-posts-slider-swiper-space-between:' . $array['space_between'] . 'px;';	
	
	BTBB_Light::responsive_data_override_style_var(
		$style, $data_override_style_var,
		array(
			'prefix' => 'hero-posts-slider-swiper-',
			'suffix' => '-',
			'param' =>  'slides-per-view',
			'value' =>  $array['slides_per_view']
		)
	);
	
	/* ------------ */
	/* -- Custom -- */
	/* ------------ */
	
	$class[] = $array['custom_class'];
	$style[] = trim( preg_replace( '/\s+/', ' ', $array['custom_style'] ));
	$custom_params = str_replace( '``', '"', $array['custom_params'] );
	// $id = $array['custom_id'] != '' ? $array['custom_id'] : uniqid( 'hero-posts-slider-swiper-' );
	$id = $array['custom_id'];
	
	/* ------------ */
	/* -- Output -- */
	/* ------------ */
	
	wp_enqueue_script( 
		'swiper',
		plugin_dir_url( __FILE__ ) . '../js/swiper-bundle.min.js',
		array( 'jquery' )
	);
	wp_enqueue_script( 
		'hero-posts-swiper-helper',
		plugin_dir_url( __FILE__ ) . '../js/hero-posts-swiper-helper.js',
		array( 'jquery', 'swiper' )
	);
	wp_enqueue_style( 
		'hero-posts-swiper', 
		plugin_dir_url( __FILE__ ) . '../css/swiper-bundle.min.css'
	);
	
	$slides_per_view_arr = explode(',;,', $array['slides_per_view']);
	while ( count( $slides_per_view_arr ) < 6 ) { $slides_per_view_arr[] = $slides_per_view_arr[ count( $slides_per_view_arr )-1 ]; } 			// extend array
	for( $i = 0; $i < count( $slides_per_view_arr ); $i++ ){													// fill the missing values
		$slides_per_view_arr[$i] = ( intval( $slides_per_view_arr[$i] ) > 0 ) ? $slides_per_view_arr[$i] : $slides_per_view_arr[0];
	}
	
	/* Swiper data */
	
	$output_data_swiper = '{ ';

	if( $array['space_between'] != 'inherit' ) {
		$output_data_swiper .= '"spaceBetween": ' .  $array['space_between'] . ', ';
	} else {	
		// $output_data_swiper .= 'spaceBetween: convertToUnitlessPixels( jQuery( " #' . esc_attr( $id ) . '" ) ), ';	
		$output_data_swiper .= '"spaceBetween": "inherit", ';	
		$output_data_swiper .= '"parentElement": "#' . $id . '", ';	
	}

	if ( $array['effect'] == 'fade' ) {
		$output_data_swiper .= '"slidesPerView": 1, "effect": "fade", "fadeEffect": { "crossFade": true }, ';
	} else if ( $array['effect'] == 'cube' ) {
		$output_data_swiper .= '"slidesPerView": 1, "effect": "cube", ';
	} else {
		$output_data_swiper .= '"slidesPerView": ' .  intval( $slides_per_view_arr[0] ) . ', ';
			$output_data_swiper .= '"breakpoints": { "1400": { "slidesPerView": ' .  intval( $slides_per_view_arr[0] ) . ' } ';
				if ( $slides_per_view_arr[1] != '' ) $output_data_swiper .= ', "1200": { "slidesPerView": ' .  intval( $slides_per_view_arr[1] ) . ' } ';
				if ( $slides_per_view_arr[1] != '' ) $output_data_swiper .= ', "993": { "slidesPerView": ' .  intval( $slides_per_view_arr[2] ) . ' } ';
				if ( $slides_per_view_arr[2] != '' ) $output_data_swiper .= ', "769": { "slidesPerView": ' .  intval( $slides_per_view_arr[3] ) . ' } ';
				if ( $slides_per_view_arr[3] != '' ) $output_data_swiper .= ', "481": { "slidesPerView": ' .  intval( $slides_per_view_arr[4] ) . ' } ';
				if ( $slides_per_view_arr[4] != '' ) $output_data_swiper .= ', "0": { "slidesPerView": ' .  intval( $slides_per_view_arr[5] ) . ' } ';
			$output_data_swiper .= '}, ';
	}


	if ( intval( $array['autoplay_delay'] ) > 0 ) {
		$output_data_swiper .= '"autoplay": { "delay": ' . $array['autoplay_delay'] . ', "disableOnInteraction": false, "pauseOnMouseEnter": true }, ';
	}
	if ( $array['pagination'] != 'none' ) {
		$output_data_swiper .= '"pagination": { "el": ".swiper-pagination", "clickable": true, "type": "' . $array['pagination'] . '" }, ';
	}
	if ( $array['navigation'] != 'none' ) {
		$output_data_swiper .= '"navigation": { "nextEl": "#' . esc_attr( $id ) . ' .swiper-button-next", "prevEl": "#' . esc_attr( $id ) . ' .swiper-button-prev" }';
	}
	if ( $custom_params != '' ) {
		$output_data_swiper .=  ', ' . $custom_params;
	}
	$output_data_swiper .= '}';
	
	// var_dump( $output_data_swiper );
	// var_dump( $data_override_style_var );
	
	/* HTML output */
	
	$output = '';	
	$output .= '<div class="' . esc_attr( implode( ' ', $class ) ) . '" style="' . esc_attr( implode( '; ', $style ) ) . '" id="' . esc_attr( $id ) . '" data-btbbl-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '" data-btbbl-override-style-var="' . htmlspecialchars( json_encode( $data_override_style_var, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '"/>';
		$output .= '<div class="hero-posts-slider-swiper-holder" id="' . esc_attr( $id ) . '-base" data-hero-posts-swiper="' . htmlspecialchars( ( $output_data_swiper ), ENT_QUOTES, 'UTF-8' ) . '">';
			$output .= '<div class="swiper-wrapper hero-posts-slider-swiper-wrapper">';
				if (  isset( $array['content'] ) && is_array( $array['content'][0] ) ) {
					foreach( $array['content'] as $item ) {
						$output .= self::display( $item );
					}			
				}
			$output .= '</div>';
			 if ( $array['pagination'] != 'none' ) { $output .= '<div class="swiper-pagination"></div>'; }
		$output .= '</div>';
		if ( $array['navigation'] != 'none' ) { $output .= '<div class="hero-posts-slider-swiper-button swiper-button-prev"></div><div class="hero-posts-slider-swiper-button swiper-button-next"></div>'; }
	$output .= '</div>';
	
	/* Swiper script / deprecated */
	
	/*$output_script = '';
	$output_id = 'swiper_' . str_replace( "-", "_", $id );

	$output_script .= 'jQuery(document).ready(function(){ ';
		$output_script .= 'jQuery(" #' . esc_attr( $id ) . '-base" ).addClass( "swiper" ); ';
		$output_script .= 'const ' . esc_attr( $output_id ) . ' = new Swiper(" #' . esc_attr( $id ) . '-base ", ';
			
		$output_script .= $output_data_swiper . ');';
	$output_script .= '});';
	
	wp_add_inline_script( 
		'hero-posts-swiper-helper', 
		$output_script 
	);*/
	
	return $output;