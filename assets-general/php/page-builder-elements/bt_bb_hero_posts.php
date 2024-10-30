<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	

if ( ! class_exists( 'hero_posts_bt_bb' ) && class_exists( 'BT_BB_Element' ) ) {

	class hero_posts_bt_bb extends BT_BB_Element {

			function handle_shortcode( $atts, $content ) {
				extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
					'hero_post'       => ''
				) ), $atts, $this->shortcode ) );

				$class		= array( $this->shortcode );
				$class[]	= 'bt-bb-hero-posts';

				if ( $el_class != '' ) {
					$class[] = $el_class;
				}

				$id_attr = '';
				if ( $el_id != '' ) {
					$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
				}

				$style_attr = '';
				$el_style = apply_filters( $this->shortcode . '_style', $el_style, $atts );
				if ( $el_style != '' ) {
					$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
				}

				do_action( $this->shortcode . '_before_extra_responsive_param' );
				foreach ( $this->extra_responsive_data_override_param as $p ) {
					if ( ! is_array( $atts ) || ! array_key_exists( $p, $atts ) ) continue;
					$this->responsive_data_override_class(
						$class, $data_override_class,
						apply_filters( $this->shortcode . '_responsive_data_override', array(
							'prefix' => $this->prefix,
							'param' => $p,
							'value' => $atts[ $p ],
						) )
					);
				}

				$class = apply_filters( $this->shortcode . '_class', $class, $atts );

				$output = '';

				if ( isset( $hero_post ) ) {
					$output .=  do_shortcode( '[hero_posts id="' . $hero_post . '"]' ); // [hero_posts id="948"]
				}

				$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . '>' . $output . '</div>';

				$output = apply_filters( 'bt_bb_general_output', $output, $atts );
				$output = apply_filters( $this->shortcode . '_output', $output, $atts );


				return $output;
			}

			function map_shortcode() {
				$hero_posts = function_exists( 'hero_posts_get_hero_posts_wpbakery_bb' ) ? hero_posts_get_hero_posts_wpbakery_bb() : array(); 

				bt_bb_map( $this->shortcode, array( 'name' => HERO_POSTS_ELEMENT_NAME, 'description' => HERO_POSTS_ELEMENT_DESCRIPTION,  
				'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
					'params' => array(
							array( 'param_name' => 'hero_post', 'type' => 'dropdown', 'heading' => HERO_POSTS_FIELD_TITLE, 'description' => HERO_POSTS_FIELD_DESCRIPTION, 'value' => $hero_posts, 'preview' => true ),
						) 
				) );
			} 

	}

	new hero_posts_bt_bb();

	require_once wp_normalize_path(  __DIR__ . '/../bb/index.php' );

}

