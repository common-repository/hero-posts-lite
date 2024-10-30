<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
/**
 * Avada Hero Posts Fusion Page Builder Element
 */

// Init the elements.
function her_posts_fusion_builder_elements_init() {
	include_once wp_normalize_path(  __DIR__ . '/../fusion/index.php' );
}
add_action( 'fusion_builder_shortcodes_init', 'her_posts_fusion_builder_elements_init', 10 );

