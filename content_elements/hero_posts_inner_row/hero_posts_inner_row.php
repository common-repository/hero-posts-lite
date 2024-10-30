<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
class Hero_Posts_Inner_Row extends Hero_Posts_Base {
	
	static function init() {
		add_shortcode( 'hero_posts_inner_row', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( 
			shortcode_atts( 
				array(
					'column_gap'     			=> 'inherit',
					// 'items_height'     		=> 'auto',
					
					/* Custom */
					'custom_id'   				=> '',
					'custom_class'   			=> '',
					'custom_style'   			=> '',
				), 
				$atts, 
				'hero_posts_inner_row' 
			) 
		);
		
		$parts = self::get_content_parts( $content );
		
		$custom_id = $custom_id != '' ? $custom_id : uniqid( 'hero-posts-row-' );
		
		$my_data = array(
			'iden' 								=> 'hero_posts_inner_row',
			'column_gap' 						=> $column_gap,
			// 'items_height' 					=> $items_height,
			'custom_id' 						=> $custom_id,
			'custom_class' 						=> $custom_class,
			'custom_style' 						=> $custom_style,
			'content' 							=> $parts,
		);
		
		return ( serialize( $my_data ) . self::get_delimiter() );
	}
}

Hero_Posts_Inner_Row::init();


// Map shortcode

function hero_posts_inner_row_map() {
	
	$params = array(
		/*array( 
			'param_name' 		=> 'items_height',
			'type' 				=> 'dropdown', 
			'default' 			=> 'auto', 
			'heading' 			=> esc_html__( 'Items height', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'Auto', 'hero-posts' ) 						=> 'auto',
				esc_html__( 'Keep equal heights', 'hero-posts' ) 		=> 'keep'
			)
		),*/
		array( 
			'param_name' 		=> 'column_gap', 
			'type' 				=> 'dropdown', 
			'default'			=> 'inherit', 
			'heading' 			=> esc_html__( 'Column gap', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> hero_posts_get_gaps( true )
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
		'hero_posts_inner_row', 
		array( 
			'name' 							=> esc_html__( 'Inner row', 'hero-posts' ),  
			'description' 					=> esc_html__( '', 'hero-posts' ),  
			'container' 					=> 'horizontal', 
			'icon' 							=> 'bt_bb_icon_hero_posts_inner_row', 
			'accept' 						=> array( 'hero_posts_inner_column' => true ), 
			'auto_add' 						=> 'hero_posts_inner_column',
			'show_settings_on_create' 		=> true, 
			'params' 						=> $params 
		)
	);
}

add_action( 'wp_loaded', 'hero_posts_inner_row_map' );