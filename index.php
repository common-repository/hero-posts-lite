<?php

/**
 * Plugin Name: Hero Posts Lite
 * Description: Hero Posts Lite Plugin by BoldThemes.
 * Version: 1.0.2
 * Author: BoldThemes
 * Author URI: https://bold-themes.com/
 */
 
// Lite / full version check

if ( function_exists( 'hero_posts_admin_enqueue' ) ) {
	die( '<p style="font-family: -apple-system,BlinkMacSystemFont,Roboto,Oxygen-Sans,Ubuntu,Cantarell,sans-serif; font-size: 16px; line-height: 1.5; font-weight: 600;">Could not activate Hero posts lite, please deactivate Hero posts first.</p>' );	
}
 
// BB Light 

require_once( 'bold-builder-light/bold-builder-light.php' );

// Base class

require_once( 'assets-general/php/hero_posts_base.php' );
	
// Helpers

require_once( 'assets-general/php/hero_posts_helpers.php' );
  
// BB Light Init

class Hero_Posts {
	static $builder;
	static $templates;
	static $template_path;
}
 
Hero_Posts::$builder = new BTBB_Light (
	array(
		'slug' 				=> 'hero-posts',
		'single_name' 		=> esc_html__( 'Hero Posts Lite', 'hero-posts' ),
		'plural_name' 		=> esc_html__( 'Hero Posts', 'hero-posts' ),
		'icon' 				=> 'dashicons-clock',
		'home_url' => '//bold-themes.com',
		'doc_url' => '//documentation.bold-themes.com/hero-posts',
		'support_url' => '',
		'changelog_url' => '',
		'shortcode' => 'hero_posts',
		'product_id' => '',
		'plugin_file_path' => __FILE__
	)
);

Hero_Posts::$template_path = 'assets/templates/';

// Templates

require_once( Hero_Posts::$template_path . 'templates.php' );

// Map BBL shortcodes

$glob_match = glob( plugin_dir_path( __FILE__ ) . 'content_elements/*/*.php' );

$elements = array();

if ( $glob_match ) {
	foreach( $glob_match as $file ) {
		if ( preg_match( '/(\w+)\/\1.php$/', $file, $match ) ) {
			$elements[ $match[1] ] = $file;
		}
	}
}

foreach( $elements as $key => $value ) {
	require( $value );
}

// Page builder elements

define( 'HERO_POSTS_ELEMENT_NAME', esc_html__( 'BoldThemes Hero Posts Lite', 'hero-posts' ) );
define( 'HERO_POSTS_ELEMENT_DESCRIPTION', esc_html__( 'Shortcode outputs BoldThemes Hero Posts Lite.', 'hero-posts' ) );
define( 'HERO_POSTS_ELEMENT_CLASS', 'hero-posts' );

define( 'HERO_POSTS_FIELD_TITLE', esc_html__( 'Hero Posts', 'hero-posts' ) );
define( 'HERO_POSTS_FIELD_DESCRIPTION', esc_html__( 'This is hero post lite to show in the shortcode', 'hero-posts' ) );

define( 'HERO_POSTS_WPBAKERY_CATEGORY', esc_html__( 'by BoldThemes', 'hero-posts' ) );
define( 'HERO_POSTS_ELEMENTOR_CATEGORY', esc_html__( 'BoldThemes Widgets', 'hero-posts' ) );

require_once( 'assets-general/php/page-builder-elements/elementor.php' );
require_once( 'assets-general/php/page-builder-elements/gutenberg.php' );
require_once( 'assets-general/php/page-builder-elements/bt_bb_hero_posts.php' );
require_once( 'assets-general/php/page-builder-elements/wpbakery.php' );
require_once( 'assets-general/php/page-builder-elements/fusion.php' );

// Admin CSS

if ( !function_exists( 'hero_posts_admin_enqueue' ) ) {
	function hero_posts_admin_enqueue() {
		wp_enqueue_style( 'hero-posts-admin-style', plugin_dir_url( __FILE__ ) . 'admin-style.css' );
		wp_enqueue_script( 'hero-posts', plugins_url( 'assets-general/js/hero-posts-admin.js', __FILE__ ) );
	}	
}

if ( isset( $_GET['page'] ) && $_GET['page'] == 'hero-posts-edit' ) {
	add_action( 'admin_enqueue_scripts', 'hero_posts_admin_enqueue', 100 );
	add_action( 'admin_footer', function() {
		echo '<script>';
		echo 'window.bt_bb_responsive_override_layout = true;';
		echo 'window.bt_bb_responsive_layout_extra_elements = ["hero_posts_row", "hero_posts_inner_row"];'; 
		echo 'window.bt_bb_hero_text = {};';
		echo 'window.bt_bb_hero_text.add_template = "'. esc_html__( 'Add Template', 'hero-posts' ) .'";';
		echo 'window.bt_bb_hero_text.view_demo = "'. esc_html__( 'View demo: ', 'hero-posts' ) .'";';
		echo 'window.bt_bb_hero_templates = JSON.parse(\'' . wp_json_encode( Hero_Posts::$templates ) . '\');';
		echo 'window.bt_bb_hero_templates_url = "' . plugin_dir_url( __FILE__ ) . Hero_Posts::$template_path . '";';
		echo '</script>';
	} );
}

// Front end css
if ( !function_exists( 'hero_posts_front_end_style' ) ) {
	function hero_posts_front_end_style() {
		$plugin_url = plugin_dir_url( __FILE__ );
		wp_enqueue_style( 'style',  $plugin_url . "/style.css");
	}
}

add_action( 'wp_enqueue_scripts', 'hero_posts_front_end_style' );
