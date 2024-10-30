<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
/**
 * Init BoldThemes Elementor Widgets Category
 */
function hero_posts_elementor_widget_categories_init_new( $elements_manager ) {	
	$elements_manager->add_category(
		'bold-themes',
		[
			'title' => HERO_POSTS_ELEMENTOR_CATEGORY,
			'icon' => 'fa fa-plug',
		]
	);
}
add_action( 'elementor/elements/categories_registered', 'hero_posts_elementor_widget_categories_init_new' );


 /**
 * Register new Elementor widgets. As of Elementor 3.5
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function hero_posts_elementor_widgets_register_new( $widgets_manager ) {
	require_once( wp_normalize_path(  __DIR__ . '/../elementor/index.php' ) );
	$widgets_manager->register( new \Hero_Posts_Elementor() );
}
add_action( 'elementor/widgets/register', 'hero_posts_elementor_widgets_register_new' );


/**
 * Register new Elementor widgets. Prior to Elementor 3.5
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function hero_posts_elementor_widgets_register_new_old_versions( $widgets_manager ) {
	require_once( wp_normalize_path(  __DIR__ . '/../elementor/index.php' ) );
	$widgets_manager->register_widget_type( new \Hero_Posts_Elementor() );
}
//add_action( 'elementor/widgets/widgets_registered', 'hero_posts_elementor_widgets_register_new_old_versions' );

