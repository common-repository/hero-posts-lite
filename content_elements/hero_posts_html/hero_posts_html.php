<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
class Hero_Posts_HTML extends Hero_Posts_Base {
	
	static function init() {
		add_shortcode( 'hero_posts_html', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( 
			shortcode_atts( 
				array(
					/* Custom */
					'custom_id'   				=> '',
					'custom_class'   			=> '',
					'custom_style'   			=> '',
				), 
				$atts, 
				'hero_posts_html' 
			) 
		);
		
		// $parts = self::get_content_parts( $content );
		
		$custom_id = $custom_id != '' ? $custom_id : uniqid( 'hero-posts-html-' );
		
		$my_data = array(
			'iden' 								=> 'hero_posts_html',
			'custom_id' 						=> $custom_id,
			'custom_class' 						=> $custom_class,
			'custom_style' 						=> $custom_style,
			'content' 							=> $content
		);
		return serialize( $my_data ) . self::get_delimiter();
	}
}

Hero_Posts_HTML::init();


// Map shortcode

function hero_posts_html_map() {
	
	$params = array(

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
		'hero_posts_html', 
		array( 
			'name' 							=> esc_html__( 'HTML', 'hero-posts' ), 
			'description' 					=> esc_html__( 'Classic WYSIWYG editor', 'hero-posts' ), 
			'container' 					=> 'vertical', 
			'icon' 							=> 'bt_bb_icon_hero_posts_html', 
			'accept' 						=> array( '_content' => true ), 
			'show_settings_on_create' 		=> false,
			// 'auto_add' 						=> '_content',
			'params' 						=> $params 
		)
	);
}

add_action( 'wp_loaded', 'hero_posts_html_map' );