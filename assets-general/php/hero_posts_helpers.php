<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
function hero_posts_decode( $code ) {
	return base64_decode( $code );
}	



function hero_posts_get_gaps ( $inherit = false ) {
	$output = $inherit ? array( esc_html__( 'Inherit from container base gap', 'hero-posts' ) => 'inherit' ) : array();
	for ( $i = 0; $i <= 40; $i++ ) {
		$output[ $i . 'px' ] = $i . 'px';
	}
	for ( $i = 1; $i <= 20; $i++ ) {
		$output[ $i . 'em' ] = $i . 'em'; 
	}
	return $output;
}

/* Used in Swiper slider */

function hero_posts_get_gaps_px_no_units ( $inherit = false ) {
	$output = $inherit ? array() : array( esc_html__( 'Inherit from container base gap', 'hero-posts' ) => 'inherit' );
	$i = 0;
	while ( $i <= 20 ) {
		$output[ $i . 'px' ] = $i;
		$i++;  
	}
	return $output;
}

function hero_posts_get_border_radiuses ( $inherit = false ) {
	$output = $inherit ? array( esc_html__( 'Inherit', 'hero-posts' ) => 'inherit' ) : array();
	for ( $i = 0; $i <= 20; $i++ ) {
		$output[ $i . 'px' ] = $i . 'px';
	}
	for ( $i = 1; $i <= 10; $i++ ) {
		$output[ ( $i * 10 ) . '%' ] = ( $i * 10 ) . '%'; 
	}
	return $output;
}

function hero_posts_get_post_elements () {
	$output = array(
		esc_html__( 'Title', 'hero-posts' ) 					=> 'title',
		esc_html__( 'Categories', 'hero-posts' ) 				=> 'categories',
		esc_html__( 'Tags', 'hero-posts' ) 						=> 'tags',
		esc_html__( 'Author name', 'hero-posts' ) 				=> 'author_name',
		esc_html__( 'Author photo', 'hero-posts' ) 				=> 'author_photo',
		esc_html__( 'Date', 'hero-posts' ) 						=> 'date',
		esc_html__( 'Time', 'hero-posts' ) 						=> 'time',
		esc_html__( 'Date & time', 'hero-posts' ) 				=> 'date_time',
		esc_html__( 'Time ago', 'hero-posts' ) 					=> 'time_ago',
		esc_html__( 'Comments number', 'hero-posts' ) 			=> 'comments_number',
		esc_html__( 'Post format', 'hero-posts' ) 				=> 'post_format',
		esc_html__( 'Reading time', 'hero-posts' ) 				=> 'reading_time',
		esc_html__( 'Sticky mark', 'hero-posts' ) 				=> 'sticky_mark',
	);
	return $output;
}

function hero_posts_get_overlay_background_colors() {
	$output = array(
		esc_html__( 'Dark 0%', 'hero-posts' ) 				=> 'dark-color-0',
		esc_html__( 'Dark 10%', 'hero-posts' ) 				=> 'dark-color-10',
		esc_html__( 'Dark 20%', 'hero-posts' ) 				=> 'dark-color-30',
		esc_html__( 'Dark 30%', 'hero-posts' ) 				=> 'dark-color-30',
		esc_html__( 'Dark 40%', 'hero-posts' ) 				=> 'dark-color-40',
		esc_html__( 'Dark 50%', 'hero-posts' ) 				=> 'dark-color-50',
		esc_html__( 'Dark 60%', 'hero-posts' ) 				=> 'dark-color-60',
		esc_html__( 'Dark 70%', 'hero-posts' ) 				=> 'dark-color-70',
		esc_html__( 'Dark 80%', 'hero-posts' ) 				=> 'dark-color-80',
		esc_html__( 'Dark 90%', 'hero-posts' ) 				=> 'dark-color-90',
		esc_html__( 'Dark 100%', 'hero-posts' ) 			=> 'dark-color-100',
		esc_html__( 'Light 0%', 'hero-posts' ) 				=> 'light-color-0',
		esc_html__( 'Light 10%', 'hero-posts' ) 			=> 'light-color-10',
		esc_html__( 'Light 20%', 'hero-posts' ) 			=> 'light-color-30',
		esc_html__( 'Light 30%', 'hero-posts' ) 			=> 'light-color-30',
		esc_html__( 'Light 40%', 'hero-posts' ) 			=> 'light-color-40',
		esc_html__( 'Light 50%', 'hero-posts' ) 			=> 'light-color-50',
		esc_html__( 'Light 60%', 'hero-posts' ) 			=> 'light-color-60',
		esc_html__( 'Light 70%', 'hero-posts' ) 			=> 'light-color-70',
		esc_html__( 'Light 80%', 'hero-posts' ) 			=> 'light-color-80',
		esc_html__( 'Light 90%', 'hero-posts' ) 			=> 'light-color-90',
		esc_html__( 'Light 100%', 'hero-posts' ) 			=> 'light-color-100',
		esc_html__( 'Accent 0%', 'hero-posts' ) 			=> 'accent-color-0',
		esc_html__( 'Accent 10%', 'hero-posts' ) 			=> 'accent-color-10',
		esc_html__( 'Accent 20%', 'hero-posts' ) 			=> 'accent-color-30',
		esc_html__( 'Accent 30%', 'hero-posts' ) 			=> 'accent-color-30',
		esc_html__( 'Accent 40%', 'hero-posts' ) 			=> 'accent-color-40',
		esc_html__( 'Accent 50%', 'hero-posts' ) 			=> 'accent-color-50',
		esc_html__( 'Accent 60%', 'hero-posts' ) 			=> 'accent-color-60',
		esc_html__( 'Accent 70%', 'hero-posts' ) 			=> 'accent-color-70',
		esc_html__( 'Accent 80%', 'hero-posts' ) 			=> 'accent-color-80',
		esc_html__( 'Accent 90%', 'hero-posts' ) 			=> 'accent-color-90',
		esc_html__( 'Accent 100%', 'hero-posts' ) 			=> 'accent-color-100'
	);
	return $output;
}

function hero_posts_get_overlay_opacities() {
	$output = array(
		esc_html__( '100%', 'hero-posts' ) 						=> '100',
		esc_html__( '90%', 'hero-posts' ) 						=> '90',
		esc_html__( '80%', 'hero-posts' ) 						=> '80',
		esc_html__( '70%', 'hero-posts' ) 						=> '70',
		esc_html__( '60%', 'hero-posts' ) 						=> '60',
		esc_html__( '50%', 'hero-posts' ) 						=> '50',
		esc_html__( '40%', 'hero-posts' ) 						=> '40',
		esc_html__( '30%', 'hero-posts' ) 						=> '30',
		esc_html__( '20%', 'hero-posts' ) 						=> '20',
		esc_html__( '10%', 'hero-posts' ) 						=> '10',
		esc_html__( '0%', 'hero-posts' ) 						=> '0'
	);
	return $output;
}

function hero_posts_convert_fraction_to_decimal( $fraction ) {
    $numbers = explode( "/", $fraction );
    return round( $numbers[0] / $numbers[1], 6 );
}

function hero_posts_get_post_reading_time( $content ) {
	$wpm = intval( get_option( 'hero_posts_words_per_minute' ) );
	if ( $wpm <= 0 ) $wpm = 100;
	$w = str_word_count( $content );
	return round( $w / $wpm );
}	

function hero_posts_convert_to_time_ago( $orig_time ) {
	$orig_time = strtotime( $orig_time );
	return human_time_diff( $orig_time,  current_time( 'timestamp' ) ).' '.__( 'ago', 'hero-posts' );
}

function hero_posts_get_image_sizes() {
	global $_wp_additional_image_sizes;

	foreach ( get_intermediate_image_sizes() as $_size ) {
		$sizes[ $_size ] = $_size;
	}

	$sizes[ 'full' ] = 'full';

	return array_reverse( $sizes );
}

function hero_posts_get_hero_posts() {
	$args = array(
        'post_type'			=> 'hero-posts',
		'post_status'		=> 'publish',
        'posts_per_page'	=> -1
    );
	$hero_posts = new WP_Query($args);

	$hero_posts_data = array();	
	if ( isset( $hero_posts ) && $hero_posts->have_posts() ) {
		while ( $hero_posts->have_posts() ) {			
			$hero_posts->the_post();
			$post		= get_post();
			$post_id	= get_the_ID();

			$posts_data			= array();
			$post_data['ID']	= $post_id;
			$post_data['title'] = get_the_title( $post_id );
			$hero_posts_data[]	= $post_data;
		}
		wp_reset_postdata();			
	} 
	
	$hero_posts_arr = array( '0' => esc_html__( '', 'hero-posts' ) );
	foreach ( $hero_posts_data as $item) {		
		if ( $item ) {			
			$hero_posts_arr[ $item["ID"] ] = $item["title"]; 
		}
	}
	
	return $hero_posts_arr;
}

function hero_posts_get_hero_posts_wpbakery_bb() {
	$args = array(
        'post_type'			=> 'hero-posts',
		'post_status'		=> 'publish',
        'posts_per_page'	=> -1
    );
	$hero_posts = new WP_Query($args);

	$hero_posts_data = array();	
	if ( isset( $hero_posts ) && $hero_posts->have_posts() ) {
		while ( $hero_posts->have_posts() ) {			
			$hero_posts->the_post();
			$post		= get_post();
			$post_id	= get_the_ID();

			$posts_data			= array();
			$post_data['ID']	= $post_id;
			$post_data['title'] = get_the_title( $post_id );
			$hero_posts_data[]	= $post_data;
		}
		wp_reset_postdata();			
	} 
	
	$hero_posts_arr = array( esc_html__( '', 'hero-posts' ) => '0' );
	foreach ( $hero_posts_data as $item) {	
		if ( $item ) {	
			$hero_posts_arr[$item["title"]] =   $item["ID"] ;
		}
	}
	
	return $hero_posts_arr;
}
