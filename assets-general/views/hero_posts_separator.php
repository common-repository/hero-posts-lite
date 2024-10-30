<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		
	$data_override_class = array();
	$data_override_style_var = array();
	
	/* ----------- */
	/* -- Class -- */
	/* ----------- */
	
	$class[] = 'hero-posts-separator';
	
	/* ----------- */
	/* -- Style -- */
	/* ----------- */
	
	BTBB_Light::responsive_data_override_style_var(
		$style, $data_override_style_var,
		array(
			'prefix' => 'hero-posts-separator-',
			'suffix' => '-',
			'param' =>  'top-margin',
			'value' =>  $array['top_margin']
		)
	);
	BTBB_Light::responsive_data_override_style_var(
		$style, $data_override_style_var,
		array(
			'prefix' => 'hero-posts-separator-',
			'suffix' => '-',
			'param' =>  'bottom-margin',
			'value' =>  $array['bottom_margin']
		)
	);
	BTBB_Light::responsive_data_override_style_var(
		$style, $data_override_style_var,
		array(
			'prefix' => 'hero-posts-separator-',
			'suffix' => '-',
			'param' =>  'line-width',
			'value' =>  $array['line_width']
		)
	);
	$style[] = '--hero-posts-separator-line-style: ' . $array['line_style'];	
	// $style[] = '--hero-posts-separator-line-width: ' . $array['line_width'];	
	$array['line_color'] = $array['line_color'] != '' ? $array['line_color'] : '#cccccc';
	$style[] = '--hero-posts-separator-line-color: ' . $array['line_color'];	
	
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

	$output .= '<hr class="' . esc_attr( implode( ' ', $class ) ) . '" style="' . esc_attr( implode( '; ', $style ) ) . '" id="' . esc_attr( $id ) . '" data-btbbl-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '" data-btbbl-override-style-var="' . htmlspecialchars( json_encode( $data_override_style_var, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '"/>';
	
	return $output;