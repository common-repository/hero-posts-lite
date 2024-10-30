<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
class Hero_Posts_Container extends Hero_Posts_Base {
	
	static function init() {
		add_shortcode( 'hero_posts_container', array( __CLASS__, 'handle_shortcode' ) );
	}
		
	static function count_array_items( $v,  $a ) {
		$count = 0;
		array_walk_recursive( $a, function( $val, $key ) use ( &$count, $v ) {
			if ( $val == $v ) {
				$count++;
			}
		});
		return $count;		
	}

	static function handle_shortcode( $atts, $content ) {
		extract( 
			shortcode_atts( 
				array(
					'order_by'					=> 'none',
					'order'						=> 'DESC',
					'sticky_posts'				=> 'ignore',
					'category_filter'			=> '',
					'tag_filter'				=> '',
					'date_filter'				=> '',
					'post_format_filter'		=> '',
					'taxonomy_filter'			=> '',
					'author_filter'				=> '',
					
					/* Formatting */
					'base_gap'					=> '',
					'accent_color'				=> '',
					
					/* Custom */
					'custom_id'   				=> '',
					'custom_class'   			=> '',
					'custom_style'   			=> '',
				),
				$atts, 
				'hero_posts_container' 
			) 
		);
		
		// var_dump($order_by);
		
		$parts = self::get_content_parts( $content );
		
		$custom_id = $custom_id != '' ? $custom_id : uniqid( 'hero-posts-container-' );
		
		$my_data = array(
			'iden' 								=> 'hero_posts_container',
			'order_by' 							=> $order_by,
			'order' 							=> $order,
			'sticky_posts' 						=> $sticky_posts,
			'category_filter' 					=> $category_filter,
			'tag_filter' 						=> $tag_filter,
			'date_filter' 						=> $date_filter,
			'post_format_filter' 				=> $post_format_filter,
			'taxonomy_filter' 					=> $taxonomy_filter,
			'author_filter' 					=> $author_filter,
			
			'accent_color' 						=> $accent_color,
			'base_gap' 							=> $base_gap,
			
			'custom_id' 						=> $custom_id,
			'custom_class' 						=> $custom_class,
			'custom_style' 						=> $custom_style,
			'content' 							=> $parts,
		);

		
		$filter = array();
		
		$filter['number_of_posts'] =  self::count_array_items( 'hero_posts_item',  $my_data );
		$filter['order_by'] = $order_by;
		$filter['order'] = $order;
		$filter['category_filter'] = $category_filter;
		$filter['date_filter'] = $date_filter;
		$filter['tag_filter'] = $tag_filter;
		$filter['author_filter'] = $author_filter;
		$filter['post_format_filter'] = $post_format_filter;
		$filter['taxonomy_filter'] = $taxonomy_filter;
		$filter['sticky_posts'] = $sticky_posts;
		
		self::$posts = self::filter_posts( $filter, $custom_id );
		
		return self::display( $my_data );

	}
}

Hero_Posts_Container::init();

// Map shortcode

function hero_posts_container_map() {
	
	$params = array(
		array( 
			'param_name' 		=> 'order_by', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'none', 
			'heading' 			=> esc_html__( 'Order by', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'None', 'hero-posts' ) 							=> 'none',
				esc_html__( 'Name', 'hero-posts' ) 							=> 'name',
				esc_html__( 'Author', 'hero-posts' ) 						=> 'author',
				esc_html__( 'Date', 'hero-posts' ) 							=> 'date',
				esc_html__( 'Title', 'hero-posts' ) 						=> 'title',
				esc_html__( 'Modified', 'hero-posts' ) 						=> 'modified',
				esc_html__( 'Coment count', 'hero-posts' ) 					=> 'comment_count',
				esc_html__( 'Random', 'hero-posts' ) 						=> 'rand',
			)
		),
		array( 
			'param_name' 		=> 'order', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'DESC', 
			'heading' 			=> esc_html__( 'Order direction', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'ASC', 'hero-posts' ) 							=> 'ASC',
				esc_html__( 'DESC', 'hero-posts' ) 							=> 'DESC',
			)
		),
		array( 
			'param_name' 		=> 'sticky_posts', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'DESC', 
			'heading' 			=> esc_html__( 'Sticky posts', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'Show sticky posts, but not on top', 'hero-posts' ) 			=> 'ignore',
				esc_html__( 'Show on top', 'hero-posts' ) 									=> 'top',
				esc_html__( 'Don’t show sticky posts at all', 'hero-posts' ) 				=> 'skip',
			)
		),
		array( 
			'param_name' 		=> 'category_filter', 
			'type' 				=> 'textfield', 
			'default' 			=> '', 
			'description' 		=> esc_html__( 'Category slug(s). Comma-separated (either) or plus-separated (all) (eg sport, business)', 'hero-posts' ),
			'heading' 			=> esc_html__( 'Categories', 'hero-posts' )
		),
		array( 
			'param_name' 		=> 'tag_filter', 
			'type' 				=> 'textfield', 
			'default' 			=> '', 
			'description' 		=> esc_html__( 'Tag slug(s). Comma-separated (either) or plus-separated (all) (eg sport, business)', 'hero-posts' ),
			'heading' 			=> esc_html__( 'Tags', 'hero-posts' )
		),
		array( 
			'param_name' 		=> 'date_filter', 
			'type' 				=> 'textfield', 
			'default' 			=> '', 
			'description' 		=> esc_html__( 'Type strtotime()-compatible string (eg 7 days ago, 1 month ago)', 'hero-posts' ),
			'heading' 			=> esc_html__( 'Date filter', 'hero-posts' )
		),
		array( 
			'param_name' 		=> 'post_format_filter', 
			'type' 				=> 'textfield', 
			'default' 			=> '', 
			'description' 		=> esc_html__( 'Post format, or comma-separated list of formats (eg post-format-video, post-format-audio)', 'hero-posts' ),
			'heading' 			=> esc_html__( 'Post formats', 'hero-posts' )
		),
		array( 
			'param_name' 		=> 'taxonomy_filter', 
			'type' 				=> 'textfield', 
			'default' 			=> '', 
			'description' 		=> esc_html__( 'Type /taxonomy:slug1,slug2/ separated by semicolon (eg tag:highlight,michael-jackson;custom-taxonomy:slug1,slug2)', 'hero-posts' ),
			'heading' 			=> esc_html__( 'Taxonomies', 'hero-posts' )
		),
		array( 
			'param_name' 		=> 'author_filter', 
			'type' 				=> 'textfield', 
			'default' 			=> '', 
			'description' 		=> esc_html__( 'Author ID, or comma-separated list of IDs.', 'hero-posts' ),
			'heading' 			=> esc_html__( 'Authors', 'hero-posts' )
		),
		
		/* Formatting  */
		
		array( 
			'param_name' 			=> 'base_gap',
			'type' 					=> 'dropdown', 
			'default' 				=> '10px', 
			'heading' 				=> esc_html__( 'Base gap', 'hero-posts' ), 
			'group' 				=> esc_html__( 'Formatting', 'hero-posts' ), 
			'preview' 				=> true,
			'value' 				=> hero_posts_get_gaps( false)
		),
		array( 
			'param_name' 		=> 'accent_color', 
			'type' 				=> 'colorpicker', 
			'default' 			=> 'solid', 
			'heading' 			=> esc_html__( 'Accent color', 'hero-posts' ), 
			'group' 			=> esc_html__( 'Formatting', 'hero-posts' ), 
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
		'hero_posts_container', 
		array( 
			'name' 							=> esc_html__( 'Hero posts', 'hero-posts' ), 
			'description' 					=> esc_html__( 'Hero posts container & filter', 'hero-posts' ), 
			'container' 					=> 'vertical', 
			'icon' 							=> 'bt_bb_icon_hero_posts_container', 
			'accept' 						=> array( 'hero_posts_row' => true ), 
			'show_settings_on_create' 		=> true, 
			'auto_add' 						=> 'hero_posts_row', 
			'root' 							=> true, 
			'toggle' 						=> true, 
			'params' 						=> $params,
		)
	);
}

add_action( 'wp_loaded', 'hero_posts_container_map' );