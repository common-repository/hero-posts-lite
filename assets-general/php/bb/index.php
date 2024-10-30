<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'admin_bar_init', 'hero_posts_bt_bb_fe_init' );

function hero_posts_bt_bb_fe_init() {
	if ( ! bt_bb_active_for_post_type_fe() || ( isset( $_GET['preview'] ) && ! isset( $_GET['bt_bb_fe_preview'] ) ) ) {
		return;
	}

	if ( current_user_can( 'edit_pages' ) ) {
		add_filter( 'bt_bb_fe_elements', 'hero_posts_bt_bb_fe' );
	}
}

function hero_posts_bt_bb_fe( $elements ) {
	$elements[ 'bt_bb_hero_posts' ] = array(
		'edit_box_selector' => '',
		'ajax_mejs' => true,
		'params' => array(
			'hero_post' => array(),
		),
	);
	return $elements;
}