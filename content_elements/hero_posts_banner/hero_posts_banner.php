<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	

class Hero_Posts_Banner extends Hero_Posts_Base {
	
	static function init() {
		add_shortcode( 'hero_posts_banner', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( 
			shortcode_atts( 
				array(
					'code'     					=> '',
					'border_style'     			=> 'solid',
					'border_width'     			=> '1px',
					'border_color'     			=> '',
					
					/* Custom */
					'custom_id'   				=> '',
					'custom_class'   			=> '',
					'custom_style'   			=> '',
				), 
				$atts, 
				'hero_posts_banner' 
			) 
		);
		
		$parts = self::get_content_parts( $content );
		
		$custom_id = $custom_id != '' ? $custom_id : uniqid( 'hero-posts-banner-' );
		
		$my_data = array(
			'iden' 								=> 'hero_posts_banner',
			'code' 								=> $code,
			'border_style' 						=> $border_style,
			'border_width' 						=> $border_width,
			'border_color' 						=> $border_color,
			'custom_id' 						=> $custom_id,
			'custom_class' 						=> $custom_class,
			'custom_style' 						=> $custom_style,
			'content' 							=> $parts
		);
		return serialize( $my_data ) . self::get_delimiter();
	}
}

Hero_Posts_Banner::init();


// Map shortcode

function hero_posts_banner_map() {
	
	$params = array(
		array( 
			'param_name' 		=> 'code', 
			'type' 				=> 'textarea_object', 
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Code', 'hero-posts' )
		),
		array( 
			'param_name' 		=> 'border_style', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'solid', 
			'heading' 			=> esc_html__( 'Border style', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'Solid', 'hero-posts' ) 				=> 'solid',
				esc_html__( 'Dashed', 'hero-posts' ) 				=> 'dashed',			
				esc_html__( 'Dotted', 'hero-posts' ) 				=> 'dotted',			
				esc_html__( 'None', 'hero-posts' ) 					=> 'none',			
			)
		),
		array( 
			'param_name' 		=> 'border_width', 
			'type' 				=> 'dropdown', 
			'default'			=> '1px', 
			'heading' 			=> esc_html__( 'Border width', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> hero_posts_get_gaps()
		),
		array( 
			'param_name' 		=> 'border_color', 
			'type' 				=> 'colorpicker', 
			'default' 			=> 'solid', 
			'heading' 			=> esc_html__( 'Border color', 'hero-posts' ), 
			'preview' 			=> true
		),
		/* General custom params */
		array( 
			'param_name' 		=> 'custom_id', 
			'type' 				=> 'textfield', 
			'group' 			=> esc_html__( 'Custom', 'hero-posts' ),
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Custom Id', 'hero-posts' )
		),
		array( 
			'param_name' 		=> 'custom_class', 
			'type' 				=> 'textfield', 
			'group' 			=> esc_html__( 'Custom', 'hero-posts' ),
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Custom class', 'hero-posts' )
		),
		array( 
			'param_name' 		=> 'custom_style', 
			'type' 				=> 'textarea', 
			'group' 			=> esc_html__( 'Custom', 'hero-posts' ),
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Custom style', 'hero-posts' )
		),
	);
	Hero_Posts::$builder->map( 
		'hero_posts_banner', 
		array( 
			'name' 							=> esc_html__( 'Banner', 'hero-posts' ), 
			'description' 					=> esc_html__( 'Placeholder for the banner code', 'hero-posts' ), 
			'container' 					=> 'vertical', 
			'icon' 							=> 'bt_bb_icon_hero_posts_banner', 
			'show_settings_on_create' 		=> true, 
			'params' 						=> $params 
		)
	);
}

add_action( 'wp_loaded', 'hero_posts_banner_map' );