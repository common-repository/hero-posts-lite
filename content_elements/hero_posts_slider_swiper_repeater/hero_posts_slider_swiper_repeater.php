<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
class Hero_Posts_Slider_Swiper_Repeater extends Hero_Posts_Base {
	
	static function init() {
		add_shortcode( 'hero_posts_slider_swiper_repeater', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( 
			shortcode_atts( 
				array(
					'repeat_count'     			=> '2',
					'hide_elements'     		=> 'last-separator'
				), 
				$atts, 
				'hero_posts_slider_swiper_repeater' 
			) 
		);
		
		$parts = self::get_content_parts( $content );
		$parts_repeated = $parts;
		
		if ( intval( $repeat_count ) > 1 ) {
			for ( $i = 1; $i < $repeat_count; $i++ ) {
				$parts_repeated = array_merge( $parts_repeated, $parts );
			}			
		}
		
		$my_data = array(
			'iden' 								=> 'hero_posts_slider_swiper_repeater',
			'repeat_count' 						=> $repeat_count,
			'hide_elements' 					=> $hide_elements,
			'content' 							=> $parts_repeated
		);
		return serialize( $my_data ) . self::get_delimiter();
	}
}

Hero_Posts_Slider_Swiper_Repeater::init();


// Map shortcode

function hero_posts_slider_swiper_repeater_map() {
	
	$params = array(
		array( 
			'param_name' 		=> 'repeat_count', 
			'type' 				=> 'textfield', 
			'default' 			=> '2',   
			'preview' 			=> true,
			'heading' 			=> esc_html__( 'Repeat count', 'hero-posts' )
		),
		array( 
			'param_name' 		=> 'hide_elements', 
			'type' 				=> 'checkbox_group', 
			'default' 			=> 'solid', 
			'heading' 			=> esc_html__( 'Hide elements', 'hero-posts' ),
			'value' 			=> array(
				esc_html__( 'First separator', 'hero-posts' ) 				=> 'first-separator',		
				esc_html__( 'Last separator', 'hero-posts' ) 				=> 'last-separator'		
			)
		),
	);
	Hero_Posts::$builder->map( 
		'hero_posts_slider_swiper_repeater', 
		array( 
			'name' 							=> esc_html__( 'Repeater', 'hero-posts' ), 
			'description' 					=> esc_html__( 'Repeat slides sa many times as you want', 'hero-posts' ), 
			'container' 					=> 'vertical', 
			'icon' 							=> 'bt_bb_icon_hero_posts_repeater', 
			'accept' 						=> array( 'hero_posts_slider_swiper_slide' => true ),
			'show_settings_on_create' 		=> true, 
			'params' 						=> $params 
		)
	);
}

add_action( 'wp_loaded', 'hero_posts_slider_swiper_repeater_map' );