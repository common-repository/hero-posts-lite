<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
class Hero_Posts_Inner_Column extends Hero_Posts_Base {
	
	static function init() {
		add_shortcode( 'hero_posts_inner_column', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( 
			shortcode_atts( 
				array(
					'width'     				=> '',
					'width_xl'                  => '',
					'width_lg'                  => '',
					'width_md'                  => '',
					'width_sm'                  => '',
					'width_xs'                  => '',
					'align'     				=> 'inherit',
					'vertical_align'     		=> 'top',
					'items_height'     			=> 'auto',
					
					/* Custom */
					'custom_id'   				=> '',
					'custom_class'   			=> '',
					'custom_style'   			=> '',
				), 
				$atts, 
				'hero_posts_inner_column' 
			) 
		);
		
		$parts = self::get_content_parts( $content );
		
		$custom_id = $custom_id != '' ? $custom_id : uniqid( 'hero-posts-column-' );

		$my_data = array(
			'iden' 								=> 'hero_posts_inner_column',
			'width' 							=> $width,
			'width_xl' 							=> $width_xl,
			'width_lg' 							=> $width_lg,
			'width_md' 							=> $width_md,
			'width_sm' 							=> $width_sm,
			'width_xs' 							=> $width_xs,
			'align' 							=> $align,
			'vertical_align' 					=> $vertical_align,
			'items_height' 						=> $items_height,
			'custom_id' 						=> $custom_id,
			'custom_class' 						=> $custom_class,
			'custom_style' 						=> $custom_style,
			'content' 							=> $parts,
		);
		return serialize( $my_data ) . self::get_delimiter();
	}

	static function get_responsive_suffix( $width ) {
		$array = array_map( 'trim', explode( '/', $width ) );

		if ( empty( $array ) || count( $array ) != 2 || !is_numeric( $array[0] ) || !is_numeric( $array[1] ) || $array[0] == 0 || $array[1] == 0 ) {
			$width = 12;
		} else {
			$top = $array[0];
			$bottom = $array[1];
			$width = 12 * $top / $bottom;
			if ( $width < 1 || $width > 12 ) {
				$width = 12;
			}
		}
		
		$width = str_replace( '.', '_', $width );
		
		return $width;
	}
	
}

Hero_Posts_Inner_Column::init();


// Map shortcode

function hero_posts_inner_column_map() {
	
	$params = array(
		array( 
			'param_name' 			=> 'align',  
			'responsive_override' 	=> true,
			'type' 					=> 'dropdown', 
			'default' 				=> 'left', 
			'heading' 				=> esc_html__( 'Content align', 'hero-posts' ), 
			'preview' 				=> true,
			'value' 				=> array(
				esc_html__( 'Left', 'hero-posts' ) 					=> 'left',
				esc_html__( 'Right', 'hero-posts' ) 				=> 'right',
				esc_html__( 'Center', 'hero-posts' ) 				=> 'center',
				esc_html__( 'Inherit', 'hero-posts' ) 				=> 'inherit',
			)
		),
		array( 
			'param_name' 			=> 'vertical_align', 
			'type' 					=> 'dropdown', 
			'default' 				=> 'top', 
			'heading' 				=> esc_html__( 'Vertical align', 'hero-posts' ), 
			'preview' 				=> true,
			'value'					=> array(
				esc_html__( 'Top', 'hero-posts' ) 					=> 'top',
				esc_html__( 'Middle', 'hero-posts' ) 				=> 'middle',
				esc_html__( 'Bottom', 'hero-posts' ) 				=> 'bottom'
			)
		),
		array( 
			'param_name' 		=> 'items_height',
			'type' 				=> 'dropdown', 
			'default' 			=> 'auto', 
			'heading' 			=> esc_html__( 'Items height', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'Auto', 'hero-posts' ) 						=> 'auto',
				esc_html__( 'Keep equal heights', 'hero-posts' ) 		=> 'keep'
			)
		),
		/* General custom params */
		array( 
			'param_name' 			=> 'custom_id', 
			'type' 					=> 'textfield', 
			'group' 				=> esc_html__( 'Custom', 'hero-posts' ),
			'default' 				=> '', 
			'heading' 				=> esc_html__( 'Custom Id', 'hero-posts' )
		),
		array( 
			'param_name' 			=> 'custom_class', 
			'type' 					=> 'textfield', 
			'group' 				=> esc_html__( 'Custom', 'hero-posts' ),
			'default' 				=> '', 
			'heading' 				=> esc_html__( 'Custom class', 'hero-posts' )
		),
		array( 
			'param_name' 			=> 'custom_style', 
			'type' 					=> 'textarea', 
			'group' 				=> esc_html__( 'Custom', 'hero-posts' ),
			'default' 				=> '', 
			'heading' 				=> esc_html__( 'Custom style', 'hero-posts' )
		),
	);
	Hero_Posts::$builder->map( 
		'hero_posts_inner_column', 
		array( 
			'name' 							=> esc_html__( 'Column', 'hero-posts' ), 
			'description' 					=> esc_html__( 'Hero posts column', 'hero-posts' ), 
			'width_param' 					=> 'width', 
			'container' 					=> 'vertical', 
			'icon' 							=> 'bt_bb_icon_hero_posts_inner_column',
			'accept' 						=> array( 'hero_posts_item' => true, 'hero_posts_separator' => true, 'hero_posts_banner' => true, 'hero_posts_html' => true, 'hero_posts_slider_swiper' => true, 'hero_posts_repeater' => true ),			
			'show_settings_on_create' 		=> true, 
			'params' 						=> $params 
		)
	);
}

add_action( 'wp_loaded', 'hero_posts_inner_column_map' );