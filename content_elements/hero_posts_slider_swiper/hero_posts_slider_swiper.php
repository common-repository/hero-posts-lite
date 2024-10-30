<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
class Hero_Posts_Slider_Swiper extends Hero_Posts_Base {
	
	static function init() {
		add_shortcode( 'hero_posts_slider_swiper', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( 
			shortcode_atts( 
				array(
					'slides_per_view'     				=> '1',
					'effect'     						=> 'slide',
					'space_between'     				=> '1em',
					'navigation'     					=> 'clean',
					'navigation_size'     				=> 'small',
					'navigation_position'     			=> 'inside',
					'navigation_vertical_position'     	=> 'middle',
					'pagination'     					=> 'bullets',
					'pagination_size'     				=> 'small',
					'autoplay_delay'     				=> '0',
					
					/* Custom */
					'custom_id'   				=> '',
					'custom_class'   			=> '',
					'custom_style'   			=> '',
					'custom_params'   			=> '',
				), 
				$atts, 
				'hero_posts_slider_swiper' 
			) 
		);
		
		$parts = self::get_content_parts( $content );
		
		$custom_id = $custom_id != '' ? $custom_id : uniqid( 'hero-posts-slider-swiper-' );
		
		$my_data = array(
			'iden' 								=> 'hero_posts_slider_swiper',
			'slides_per_view' 					=> $slides_per_view,
			'effect' 							=> $effect,
			'space_between' 					=> $space_between,
			'navigation' 						=> $navigation,
			'navigation_size' 					=> $navigation_size,
			'navigation_position' 				=> $navigation_position,
			'navigation_vertical_position' 		=> $navigation_vertical_position,
			'pagination' 						=> $pagination,
			'pagination_size' 					=> $pagination_size,
			'autoplay_delay' 					=> $autoplay_delay,
			'custom_params' 					=> $custom_params,
			'custom_id' 						=> $custom_id,
			'custom_class' 						=> $custom_class,
			'custom_style' 						=> $custom_style,
			'content' 							=> $parts
		);
		return serialize( $my_data ) . self::get_delimiter();
	}
}

Hero_Posts_Slider_Swiper::init();


// Map shortcode

function hero_posts_slider_swiper_map() {
	
	$params = array(
		array( 
			'param_name' 				=> 'slides_per_view', 
			'type' 						=> 'dropdown', 
			'default' 					=> '1', 
			'heading' 					=> esc_html__( 'Slides per view', 'hero-posts' ), 
			'preview' 					=> true,
			'responsive_override' 		=> true,
			'value' 					=> array(
				esc_html__( '1 slide', 'hero-posts' ) 						=> '1',			
				esc_html__( '2 slides', 'hero-posts' ) 						=> '2',			
				esc_html__( '3 slides', 'hero-posts' ) 						=> '3',			
				esc_html__( '4 slides', 'hero-posts' ) 						=> '4',			
				esc_html__( '5 slides', 'hero-posts' ) 						=> '5',			
				esc_html__( '6 slides', 'hero-posts' ) 						=> '6',			
			)
		),
		array( 
			'param_name' 		=> 'space_between', 
			'type' 				=> 'dropdown', 
			'default' 			=> '1em', 
			'heading' 			=> esc_html__( 'Space between slides', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> hero_posts_get_gaps_px_no_units()
		),
		array( 
			'param_name' 		=> 'effect', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'slide', 
			'heading' 			=> esc_html__( 'Animation effect', 'hero-posts' ), 
			'description' 		=> esc_html__( 'If cube or fade if selected, number of slides will be set to 1', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'Slide', 'hero-posts' ) 						=> 'slide',			
				esc_html__( 'Fade', 'hero-posts' ) 							=> 'fade',			
				esc_html__( 'Cube', 'hero-posts' ) 							=> 'cube',	
			)
		),
		array( 
			'param_name' 		=> 'autoplay_delay', 
			'type' 				=> 'textfield', 
			'default'			=> '0', 
			'heading' 			=> esc_html__( 'Autoplay delay (miliseconds)', 'hero-posts' ), 
			'description' 		=> esc_html__( 'eg 500; Leave 0 to disable autoplay', 'hero-posts' ), 
			'preview' 			=> true
		),
		array( 
			'param_name' 		=> 'navigation', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'clean', 
			'heading' 			=> esc_html__( 'Navigation style', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'None', 'hero-posts' ) 					=> 'none',
				esc_html__( 'Clean', 'hero-posts' ) 				=> 'clean',			
				esc_html__( 'Filled', 'hero-posts' ) 				=> 'filled',			
				esc_html__( 'Filled circle', 'hero-posts' ) 		=> 'filled-circle',			
				esc_html__( 'Outlined', 'hero-posts' ) 				=> 'outline',			
				esc_html__( 'Outlined circle', 'hero-posts' ) 		=> 'outline-circle',			
			)
		),
		array( 
			'param_name' 		=> 'navigation_size', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'small', 
			'heading' 			=> esc_html__( 'Navigation size', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'Extra small', 'hero-posts' ) 			=> 'extra-small',			
				esc_html__( 'Small', 'hero-posts' ) 				=> 'small',			
				esc_html__( 'Medium', 'hero-posts' ) 				=> 'medium',			
				esc_html__( 'Large', 'hero-posts' ) 				=> 'large',			
			)
		),
		array( 
			'param_name' 			=> 'navigation_vertical_position', 
			'type' 					=> 'dropdown', 
			'default' 				=> 'middle', 
			'heading' 				=> esc_html__( 'Navigation vertical position', 'hero-posts' ), 
			'preview' 				=> true,
			'value' 				=> array(
				esc_html__( 'Top', 'hero-posts' ) 					=> 'top',			
				esc_html__( 'Middle', 'hero-posts' ) 				=> 'middle',	
				esc_html__( 'Bottom', 'hero-posts' ) 				=> 'bottom',	
			)
		),
		array( 
			'param_name' 			=> 'navigation_position', 
			'type' 					=> 'dropdown', 
			'default' 				=> 'inside', 
			'heading' 				=> esc_html__( 'Navigation horizontal position', 'hero-posts' ), 
			'preview' 				=> true,
			'responsive_override' 	=> true,
			'value' 				=> array(
				esc_html__( 'Inside', 'hero-posts' ) 				=> 'inside',			
				esc_html__( 'Outside', 'hero-posts' ) 				=> 'outside',	
			)
		),
		array( 
			'param_name' 		=> 'pagination', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'bullets', 
			'heading' 			=> esc_html__( 'Pagination style', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'None', 'hero-posts' ) 					=> 'none',
				esc_html__( 'Bullets', 'hero-posts' ) 				=> 'bullets',		
				esc_html__( 'Progressbar', 'hero-posts' ) 			=> 'progressbar',		
				esc_html__( 'Fraction', 'hero-posts' ) 				=> 'fraction',		
			)
		),
		array( 
			'param_name' 		=> 'pagination_size', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'small', 
			'heading' 			=> esc_html__( 'Pagination size', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'Small', 'hero-posts' ) 				=> 'small',			
				esc_html__( 'Medium', 'hero-posts' ) 				=> 'medium',			
				esc_html__( 'Large', 'hero-posts' ) 				=> 'large',			
			)
		),
		array( 
			'param_name' 		=> 'custom_params', 
			'type' 				=> 'textarea', 
			// 'group' 			=> esc_html__( 'Custom', 'hero-posts' ),
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Custom Swiper additional parems', 'hero-posts' ),
			'description'		=> esc_html__( 'Fe effect: \'cube\'', 'hero-posts' )
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
		'hero_posts_slider_swiper', 
		array( 
			'name' 							=> esc_html__( 'Slider (Swiper)', 'hero-posts' ), 
			'description' 					=> esc_html__( 'Hero posts slider (Swiper)', 'hero-posts' ), 
			'container' 					=> 'vertical', 
			'icon' 							=> 'bt_bb_icon_hero_posts_slider_swiper', 
			'accept' 						=> array( 'hero_posts_slider_swiper_slide' => true, 'hero_posts_slider_swiper_repeater' => true ),
			'show_settings_on_create' 		=> true, 
			'params' 						=> $params 
		)
	);
}

add_action( 'wp_loaded', 'hero_posts_slider_swiper_map' );