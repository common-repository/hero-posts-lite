<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
		
	/* ------------ */
	/* -- Output -- */
	/* ------------ */
	
	$hidden_elements = explode( ' ', $array['hide_elements'] );
	
	$output = '';
	
	if ( count( $hidden_elements ) > 0 ) {
		if (  isset( $array['content'] ) && is_array( $array['content'][0] ) ) {
			if( $array['content'][0]['iden'] == 'hero_posts_separator' && in_array( 'first-separator', $hidden_elements ) ) {
				array_splice( $array['content'], 0, 1 );
			}
			if( $array['content'][ count( $array['content'] ) - 1 ]['iden'] == 'hero_posts_separator' && in_array( 'last-separator', $hidden_elements ) ) {
				array_splice( $array['content'], count( $array['content'] ) - 1, 1 );
			}			
		}		
	}
	
	foreach( $array['content'] as $item ) {
		$output .= self::display( $item );
	}
	return $output;