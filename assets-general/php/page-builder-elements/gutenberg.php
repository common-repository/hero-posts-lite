<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Gutenberg Hero Posts Page Builder Block
 */

function hero_posts_gutenberg_register_block() {
		if ( ! function_exists( 'register_block_type' ) ) {
			// Gutenberg is not active.
			return;
		}

		$asset_file = include plugin_dir_path( __FILE__ ) . '/../gutenberg/block.asset.php';
		wp_register_script(
			'hero-posts-gutenberg-js',
			plugins_url( '/gutenberg/block.js', dirname(__FILE__) ),
			$asset_file['dependencies'],
			$asset_file['version'],
			true
		);
		
		register_block_type('bbl/hero-posts', [
			'editor_script'		=> 'hero-posts-gutenberg-js',
			'render_callback'	=> 'hero_posts_gutenberg_render_block_callback'	
		]);
		
}
add_action( 'init', 'hero_posts_gutenberg_register_block' );

function hero_posts_gutenberg_enqueue_assets() {
	wp_enqueue_script( 'hero-posts-gutenberg-js' );
}
add_action( 'enqueue_block_editor_assets', 'hero_posts_gutenberg_enqueue_assets' );


/**
 * This function is called when the block is being rendered on the frontend
 *
 * @param array    $attributes     The array of attributes for this block.
 * @param string   $content        Rendered block output. ie. <InnerBlocks.Content />.
 * @param WP_Block $block_instance The instance of the WP_Block class that represents the block being rendered.
 */
function hero_posts_gutenberg_render_block_callback( $attributes, $content, $block_instance ) {
	ob_start();
	require plugin_dir_path( dirname(__FILE__) ) . '/gutenberg/template.php';
	return ob_get_clean();
}
