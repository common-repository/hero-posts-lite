<?php
/**
 * All of the parameters passed to the function where this file is being required are accessible in this scope:
 *
 * @param array    $attributes     The array of attributes for this block.
 * @param string   $content        Rendered block output. ie. <InnerBlocks.Content />.
 * @param WP_Block $block_instance The instance of the WP_Block class that represents the block being rendered.
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
$id = isset( $attributes['postID'] ) && intval($attributes['postID']) > 0 ? $attributes['postID'] : 0;
if ( $id > 0  ) { 
	$wrapper_attributes = get_block_wrapper_attributes( [ 'class' => HERO_POSTS_ELEMENT_CLASS . ' gutenberg-shortcode', 'style' => '', ] );
	printf( '<div %s>' . do_shortcode( '[hero_posts id="' . esc_attr( $id ). '"]' ) . '</div>', $wrapper_attributes );
} 
?>