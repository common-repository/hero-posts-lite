<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* Base classes */

class Hero_Posts_Settings {
	public function __construct() {
		add_action( 'admin_init', array( $this, 'hero_posts_add_settings_words_per_minute' ) );
		add_action( 'admin_init', array( $this, 'hero_posts_add_settings_no_image_replacement' ) );
	}

	function hero_posts_add_settings_words_per_minute() {
		add_settings_field(
			'hero_posts_words_per_minute',
			esc_html__( 'Hero posts reading speed', 'hero-posts' ),
			array( $this, 'hero_posts_settings_words_per_minute_callback_function' ),
			'reading',
			'default',
			array( 'label_for' => 'myprefix_setting-id' ),
		);
		register_setting("reading", "hero_posts_words_per_minute");
	}

	function hero_posts_settings_words_per_minute_callback_function( $args ) {
		$value = intval( get_option('hero_posts_words_per_minute') );
		$value = is_int( $value ) && intval( $value ) > 0 ? $value : 100;
		$output = '<input id="hero_posts_words_per_minute" name="hero_posts_words_per_minute" size="40" type="text" value="' . esc_attr( $value ) . '" />';
		$output .= '<p class="description">' . esc_html__( 'Enter average reading speed (words per minute), e.g. 100', 'hero-posts' ) . '</p>';
		echo wp_kses_post( $output );
	}

	function hero_posts_add_settings_no_image_replacement() {
		add_settings_field(
			'hero_posts_image_replacement',
			esc_html__( 'Hero posts image replacement', 'hero-posts' ),
			array( $this, 'hero_posts_settings_no_image_replacement_callback_function' ),
			'reading',
			'default',
			array( 'label_for' => 'myprefix_setting-id' ),
		);
		register_setting("reading", "hero_posts_image_replacement");
	}

	function hero_posts_settings_no_image_replacement_callback_function( $args ) {
		$value = get_option('hero_posts_image_replacement');
		$value = $value != '' ? $value : 'https://dummyimage.com/%1$sx%2$s/ddd/bbb.png';
		$output = '<input id="hero_posts_image_replacement" name="hero_posts_image_replacement" size="80" type="text" value="' . esc_url( $value ) . '" />';
		$output .= '<p class="description">' . esc_html__( 'Hero posts will use given service to generate dummy images for posts without featured image. Use %1$s for width, and %2$s for height. F.e. https://dummyimage.com/%1$sx%2$s/ddd/bbb.png', 'hero-posts' ) . '</p>';
		echo wp_kses( $output, array( 'input' => array( 'id' => array(), 'name' => array(), 'size' => array(), 'type' => array(), 'value' => array() ), 'p' => array( 'class' => array() )));
	}
}

$Hero_Posts_Settings = new Hero_Posts_Settings();

class Hero_Posts_Base {
	
	static $delimiter = "$%#?";
	static $posts = array();
	static $sticky_posts = array();
	
	/* Delimiter functions  */
	static function get_delimiter() {
		return self::$delimiter;
	}
	
	static function get_delimiter_length() {
		return strlen( self::$delimiter );
	}
	
	static function get_delimiter_position() {
		return -1 * self::get_delimiter_length();
	}
	
	static function get_content_parts( $content ) {
		$parts = explode( self::get_delimiter(), substr( do_shortcode( $content ), 0, self::get_delimiter_position() ) ) ;
		$parts = array_map( function( $p ) { return unserialize( $p ); }, $parts);
		return $parts;
	}
	
	/* General display */
	
	static function display( $array ) {
		require( dirname(__FILE__) . '/../views/' . $array['iden'] . '.php' );
		return $output;
	}
	
	/* Get posts */
	
	static function filter_posts( $filter, $custom_id ) {
		
		$query_args = array();
		
		/* Order */
		
		if ( $filter['order'] != '' && $filter['order_by'] != 'none' ) {
			$query_args['orderby'] 	= $filter['order_by'];
			$query_args['order'] 		= $filter['order'];
		}
		
		/* Categories */
		
		if ( $filter['category_filter'] ) $query_args['category_name'] = $filter['category_filter'];
		
		/* Number of posts */
		
		$query_args['numberposts'] 	= $filter['number_of_posts'];
		
		/* Dates */
		
		if ( $filter['date_filter'] ) {
			$query_args['date_query'] = array(
				array(
					'column' => 'post_date_gmt',
					'after' => $filter['date_filter'],
				)
			);
		}
		
		/* Tags */
		
		if ( $filter['tag_filter'] ) $query_args['tag'] = $filter['tag_filter'];
		
		/* Authors */
		
		if ( $filter['author_filter'] ) $query_args['author'] = $filter['author_filter'];
		
		/* Post format */
			
		if ( $filter['post_format_filter'] != "" ) {
			$post_format_arr = explode( ',', $filter['post_format_filter'] );
			$query_args['tax_query'][] = array(
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => $post_format_arr
				)
			);			
		}
		
		/* Taxonomy filter */
		
		if ( $filter['taxonomy_filter'] != "" ) {
			$taxonomy_list = explode( ';', $filter['taxonomy_filter'] );
			foreach ( $taxonomy_list as $single_taxonomy ) {
				$taxonomy_arr = explode( ':', $single_taxonomy );
				$taxonomy = isset($taxonomy_arr[1]) ? $taxonomy_arr[0] : 'tag';
				$taxonomy_slug = isset($taxonomy_arr[1]) ? $taxonomy_arr[1] : $taxonomy_arr[0];
				if ( $taxonomy == "tag" ) {
					$query_args['tag'] = $taxonomy_slug;
				} else {
					$query_args['tax_query'][] = array(
						array(
							'taxonomy' => $taxonomy,
							'field'    => 'slug',
							'terms'    => explode( ',', $taxonomy_slug )
						)
					);			
				}				
			} 
		}

		/* Sticky, this must be the last if-clause */
		
		$sticky_posts_arr = array();
		$regular_posts_arr = array();
		$all_posts_arr = array();
		
		$query_args['post__not_in'] 	= array();
		$query_args['post__in'] 		= array();
		
		/* Filter goes here */
		
		$query_args = apply_filters( '' . str_replace( '-', '_', $custom_id ) . '_query_filter', $query_args );
		
		$tmp_post__not_in 				= $query_args['post__not_in'];
		$tmp_post__in 					= $query_args['post__in'];
		
		if ( $filter['sticky_posts'] == 'skip' ) {
			// exclude sticky posts
			$query_args['post__not_in'] 	= array_merge( $tmp_post__not_in, get_option( 'sticky_posts' ) );
			$regular_posts_arr = self::get_posts( $query_args );
		} else if ( $filter['sticky_posts'] == 'top' ) {
			// or first get only sticky posts
			$sticky_query_args 				= $query_args;
			$sticky_query_args['post__in'] 	= array_merge( $tmp_post__in, get_option( 'sticky_posts' ) );
			$sticky_posts_arr 				= self::get_posts( $sticky_query_args );
			// and then reset number of posts and set post__not_in to get other posts
			$query_args['numberposts'] 		= $filter['number_of_posts'] - count( $sticky_posts_arr ) > -1 ? $filter['number_of_posts'] - count( $sticky_posts_arr ) : 0;
			$query_args['post__not_in'] 	= array_merge( $tmp_post__not_in, get_option( 'sticky_posts' ) );
			$regular_posts_arr 				= self::get_posts( $query_args );
		} else {
			// or just ignore sticky attribute
			$regular_posts_arr = self::get_posts( $query_args );
		}
		
		$all_posts_arr = array_merge( $sticky_posts_arr, $regular_posts_arr );
		return $all_posts_arr;
	}
	
	static function get_posts( $query_args ) {
		return get_posts( $query_args );
	}
	
	/* Get posts */
	
	static function get_and_check_the_post_thumbnail( $post_id, $image_size ) {
		$featured_image = get_the_post_thumbnail( $post_id, $image_size, array( 'loading' => 'lazy' ) );
		$no_image_replacement =  get_option('hero_posts_image_replacement');
		$no_image_replacement = $no_image_replacement != '' ? $no_image_replacement : 'https://dummyimage.com/%1$sx%2$s/ddd/bbb.png';
		if( $featured_image == "" ) {
			$all_image_sizes = wp_get_registered_image_subsizes();
			if ( array_key_exists( $image_size, $all_image_sizes ) ) {
				$width = $all_image_sizes[ $image_size ]['width'] ?: '1280';
				$height = $all_image_sizes[ $image_size ]['height'] ?: '16:9';
								
			} else {
				$width = '1280';
				$height = '16:9';
			}
			$featured_image  = sprintf( '<img src="' . $no_image_replacement . '">', $width, $height );
		} 
		return $featured_image;
	}
	
	static function get_full_post_data( $post, $params ) {
		$post->id = $post->ID;
		$post->permalink = get_permalink( $post->ID );
		$post->sticky_mark = is_sticky( $post->ID );
		$post->css_class = get_post_class( '', $post->ID );
		if ( $post->sticky_mark ) $post->css_class[] = 'sticky';
		$post->formatted_date = wp_date( get_option( 'date_format' ), strtotime( $post->post_date ) );
		$post->formatted_time = wp_date( get_option( 'time_format' ), strtotime( $post->post_date ) );
		$post->formatted_date_time = $post->formatted_date . ' ' . $post->formatted_time;
		$post->categories = wp_get_object_terms( $post->ID, 'category' );
		$post->formatted_categories = self::get_formatted_object_terms( $post->categories );
		$post->tags = wp_get_object_terms( $post->ID, 'post_tag' );
		$post->formatted_tags = self::get_formatted_object_terms( $post->tags );
		$post->comments_number = get_comments_number( $post->ID );
		$post->post_format = get_post_format( $post->ID ) ? : 'standard';
		$post->featured_image_id = get_post_thumbnail_id( $post->ID );
		$post->featured_image_url = get_the_post_thumbnail_url( $post->ID, $params['image_size'] );
		$post->featured_image = self::get_and_check_the_post_thumbnail( $post->ID, $params['image_size'] );
		$post->author_name = get_the_author_meta( 'display_name', $post->post_author );
		$post->author_url = get_author_posts_url( $post->post_author );
		$post->author_avatar_url = get_avatar_url( $post->post_author );
		$post->reading_time = hero_posts_get_post_reading_time( $post->post_content );
		// var_dump( $post );
		return $post;
	}
	
	static function get_formatted_object_terms( $terms ) {
		$show_archive_url = true;
		// $delimiter = ', ';
		$delimiter = '<span class="hero-posts-taxonomy-delimiter"></span>';
		foreach( $terms as $term ) {
			// var_dump( $term );
            $output[] = $show_archive_url ? sprintf( '<span data-slug="%2$s" class="hero-posts-taxonomy-pill"><a href="%3$s" title="%1$s" class="hero-posts-post-data-archive-url">%1$s</a></span>', $term->name, $term->slug, get_term_link( $term ) ) : sprintf( '<span data-slug="%2$s">%1$s</span>', $term->name, $term->slug );
        }
		return isset( $output ) ? implode( $delimiter, $output ) : '';
	}
	
	static function get_formatted_post_data( $data, $post ) {
		$array = explode( ' ', $data );
		$output = "";
		foreach ( $array as $item ) {
			switch ( $item ) {
				case 'sticky_mark': 
					$output .= !$post->sticky_mark ?					"" : '<span class="hero-posts-post-data hero-posts-sticky-mark" title="' . __( 'Sticky post', 'hero-posts' ) . '"><span></span></span>';
					break;
				case 'title': 
					$output .= $post->post_title == "" ? 				"" : sprintf( '<a class="hero-posts-item-content-title-a" href="%2$s" title="%1$s"><span>%1$s</span></a>', $post->post_title, $post->permalink );
					break;
				case 'categories': 
					$output .= $post->formatted_categories == "" ? 		"" : sprintf( '<span class="hero-posts-post-data hero-posts-taxonomy hero-posts-categories" title="%2$s"><span>%1$s</span></span>', $post->formatted_categories,  __( 'Post categories', 'hero-posts' ) );
					break;
				case 'tags': 
					$output .= $post->formatted_tags == "" ? 			"" : sprintf( '<span class="hero-posts-post-data hero-posts-taxonomy hero-posts-tags" title="%2$s"><span>%1$s</span></span>', $post->formatted_tags, __( 'Post tags', 'hero-posts' ) );
					break;
				case 'post_format': 
					$output .= $post->post_format == "" ? 				"" : sprintf( '<span class="hero-posts-post-data hero-posts-post-format" title="%2$s" data-format="%1$s"><span>%1$s</span></span>', $post->post_format, sprintf( esc_html__( 'Post format: %1$s.', 'hero-posts' ), $post->post_format ) );
					break;
				case 'author_name': 
					$output .= $post->author_name == "" ? 				"" : sprintf( '<span class="hero-posts-post-data hero-posts-author-name" title="%3$s"><a class="hero-posts-post-data-author-url" href="%2$s" title="%1$s">%1$s</a></span>', $post->author_name, $post->author_url, __( 'Post author', 'hero-posts' ) );
					break;
				case 'author_photo': 
					$output .= $post->author_name == "" ? 				"" : sprintf( '<span class="hero-posts-post-data hero-posts-author-photo"><img src="%1$s" title="%2$s"/></span>', $post->author_avatar_url, $post->author_name );
					break;
				case 'date': 
					$output .= $post->formatted_date == "" ? 			"" : sprintf( '<span class="hero-posts-post-data hero-posts-date" title="%2$s"><span>%1$s</span></span>', $post->formatted_date, __( 'Post date', 'hero-posts' ) );
					break;
				case 'date_time': 
					$output .= $post->formatted_date_time == "" ? 		"" : sprintf( '<span class="hero-posts-post-data hero-posts-date-time" title="%2$s"><span>%1$s</span></span>', $post->formatted_date_time, __( 'Post date & time', 'hero-posts' ) );
					break;
				case 'time': 
					$output .= $post->formatted_time == "" ? 			"" : sprintf( '<span class="hero-posts-post-data hero-posts-time" title="%2$s"><span>%1$s</span></span>', $post->formatted_time, __( 'Post time', 'hero-posts' ) );
					break;
				case 'time_ago': 
					$output .= $post->formatted_date_time == "" ? 		"" : sprintf( '<span class="hero-posts-post-data hero-posts-time-ago" title="%2$s"><span>%1$s</span></span>', hero_posts_convert_to_time_ago( $post->formatted_date_time ), __( 'Post date', 'hero-posts' ) );
					break;
				case 'comments_number': 
					$output .= $post->comments_number == "" ? 			"" : sprintf( '<span class="hero-posts-post-data hero-posts-comments-number" data-comments-number="%1$s" title="%2$s"><span>%1$s</span></span>', $post->comments_number, __( 'Number of comments', 'hero-posts' ) );
					break;
				case 'reading_time': 
					$output .= $post->reading_time == "" ? 				"" : sprintf( '<span class="hero-posts-post-data hero-posts-reading-time" title="%2$s"><span>%1$s ' . __( 'min', 'hero-posts' ) . '</span></span>', $post->reading_time, __( 'Reading time', 'hero-posts' ) );
					break;
				default: 
					$output .= "";
			}
		}
		return $output;
	}
}