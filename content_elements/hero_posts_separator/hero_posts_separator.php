<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
class Hero_Posts_Separator extends Hero_Posts_Base {
	
	static function init() {
		add_shortcode( 'hero_posts_separator', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( 
			shortcode_atts( 
				array(
					'top_margin'     			=> 'inherit',
					'bottom_margin'     		=> '1em',
					'line_style'     			=> 'none',
					'line_width'     			=> '1px',
					'line_color'     			=> 'curentcolor',
					
					/* Custom */
					'custom_id'   				=> '',
					'custom_class'   			=> '',
					'custom_style'   			=> '',
				), 
				$atts, 
				'hero_posts_separator' 
			) 
		);
		
		$parts = self::get_content_parts( $content );
		
		$custom_id = $custom_id != '' ? $custom_id : uniqid( 'hero-posts-separator-' );
		
		$my_data = array(
			'iden' 								=> 'hero_posts_separator',
			'top_margin' 						=> $top_margin,
			'bottom_margin' 					=> $bottom_margin,
			'line_style' 						=> $line_style,
			'line_width' 						=> $line_width,
			'line_color' 						=> $line_color,
			'custom_id' 						=> $custom_id,
			'custom_class' 						=> $custom_class,
			'custom_style' 						=> $custom_style,
			'content' 							=> $parts
		);
		return serialize( $my_data ) . self::get_delimiter();
	}
}

Hero_Posts_Separator::init();


// Map shortcode

function hero_posts_separator_map() {
	
	$params = array(
		array( 
			'param_name' 			=> 'top_margin',  
			'responsive_override' 	=> true,
			'type' 					=> 'dropdown', 
			'default' 				=> 'inherit', 
			'heading' 				=> esc_html__( 'Top margin', 'hero-posts' ), 
			'preview' 				=> true,
			'value' 				=> hero_posts_get_gaps( true )
		),
		array( 
			'param_name' 			=> 'bottom_margin',  
			'responsive_override' 	=> true,
			'type' 					=> 'dropdown', 
			'default' 				=> '1em', 
			'heading' 				=> esc_html__( 'Botom margin', 'hero-posts' ), 
			'preview' 				=> true,
			'value' 				=> hero_posts_get_gaps( true )
		),
		array( 
			'param_name' 		=> 'line_style', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'none', 
			'heading' 			=> esc_html__( 'Line style', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'Solid', 'hero-posts' ) 				=> 'solid',
				esc_html__( 'Dashed', 'hero-posts' ) 				=> 'dashed',			
				esc_html__( 'Dotted', 'hero-posts' ) 				=> 'dotted',			
				esc_html__( 'None', 'hero-posts' ) 					=> 'none',			
			)
		),
		array( 
			'param_name' 			=> 'line_width', 
			'responsive_override' 	=> true,
			'type' 					=> 'dropdown', 
			'default'				=> '1px', 
			'heading' 				=> esc_html__( 'Line width', 'hero-posts' ), 
			'value' 				=> hero_posts_get_gaps()
		),
		array( 
			'param_name' 		=> 'line_color', 
			'type' 				=> 'colorpicker', 
			'default' 			=> 'solid', 
			'heading' 			=> esc_html__( 'Line color', 'hero-posts' ), 
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
		'hero_posts_separator', 
		array( 
			'name' 							=> esc_html__( 'Separator', 'hero-posts' ), 
			'description' 					=> esc_html__( 'Adds space between elements, it can contain a line', 'hero-posts' ), 
			'container' 					=> 'vertical', 
			'icon' 							=> 'bt_bb_icon_hero_posts_separator', 
			'show_settings_on_create' 		=> true, 
			'params' 						=> $params 
		)
	);
}

add_action( 'wp_loaded', 'hero_posts_separator_map' );