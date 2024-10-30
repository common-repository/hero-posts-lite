<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	$data_override_class = array();
	$data_override_style_var = array();

	/* ----------- */
	/* -- Class -- */
	/* ----------- */
	
	$class[] = 'hero-posts-column';
	$class[] = 'hero-posts-item-column-vertical-align-' . $array['vertical_align'];
	$class[] = 'hero-posts-column-items-height-' . $array['items_height'];

	$tmp_width = Hero_Posts_Column::get_responsive_suffix( $array['width'], 'xxl' );
	$tmp_width .= ',;,' . Hero_Posts_Column::get_responsive_suffix( $array['width_xl'] );
	$tmp_width .= ',;,' . Hero_Posts_Column::get_responsive_suffix( $array['width_lg'] );
	$tmp_width .= ',;,' . Hero_Posts_Column::get_responsive_suffix( $array['width_md'] );
	$tmp_width .= ',;,' . Hero_Posts_Column::get_responsive_suffix( $array['width_sm'] );
	$tmp_width .= ',;,' . Hero_Posts_Column::get_responsive_suffix( $array['width_xs'] );
	
	BTBB_Light::responsive_data_override_class(
		$class, $data_override_class,
		array(
			'prefix' => 'hero-posts-column-',
			'suffix' => '-',
			'param' =>  'width',
			'value' =>  $tmp_width
		)
	);

	BTBB_Light::responsive_data_override_class(
		$class, $data_override_class,
		array(
			'prefix' => 'hero-posts-column-',
			'suffix' => '-',
			'param' =>  'align',
			'value' =>  $array['align']
		)
	);
	
	/* ----------- */
	/* -- Style -- */
	/* ----------- */
	
	
	//$style[] = '--hero-posts-column-align: ' . $array['align'];
	BTBB_Light::responsive_data_override_style_var(
		$style, $data_override_style_var,
		array(
			'prefix' => 'hero-posts-column-',
			'param' =>  'align',
			'value' =>  $array['align']
		)
	);
	
	BTBB_Light::responsive_data_override_style_var(
		$style, $data_override_style_var,
		array(
			'prefix' => 'hero-posts-column-',
			'param' =>  'order',
			'value' =>  $array['column_order']
		)
	);
	
	/* ------------ */
	/* -- Custom -- */
	/* ------------ */
	
	$class[] = $array['custom_class'];
	$style[] = trim( preg_replace( '/\s+/', ' ', $array['custom_style'] ));
	// $id = $array['custom_id'] != '' ? $array['custom_id'] : uniqid( 'hero-posts-column-' );
	$id = $array['custom_id'];
	
	/* ------------ */
	/* -- Output -- */
	/* ------------ */
	
	$output = '';
	
	$output .= '<div class="' . esc_attr( implode( ' ', $class ) ) . '" style="' . esc_attr( implode( '; ', $style ) ) . '" id="' . esc_attr( $id ) . '" data-btbbl-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '" data-btbbl-override-style-var="' . htmlspecialchars( json_encode( $data_override_style_var, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '">';
		$output .= '<div class="hero-posts-column-inner">';
			if (  isset( $array['content'] ) && is_array( $array['content'][0] ) ) {
				foreach( $array['content'] as $item ) {
					$output .= self::display( $item );
				}			
			}
		$output .= '</div>';
	$output .= '</div>';
	
	return $output;
