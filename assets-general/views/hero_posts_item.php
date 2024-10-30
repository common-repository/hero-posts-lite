<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	if ( self::$posts ) {
		$post = array_shift( self::$posts );
		$post = self::get_full_post_data( $post, $array );
	} else {
		$output = "";
		return $output;
	}
	
	$data_override_class = array();
	$data_override_style_var = array();
	
	/* ----------- */
	/* -- Class -- */
	/* ----------- */
	
	$class[] = 'hero-posts-item';
	$class[] = 'hero-posts-item-format-' . $post->post_format;
	$class[] = 'hero-posts-item-image-overlay-background-type-' . $array['image_overlay_background_gradient_type'] ;
	$class[] = 'hero-posts-item-post-format-icons-' . $array['post_format_icons'] ;
	$class[] = 'hero-posts-item-post-categories-style-' . $array['categories_style'] ;
	$class[] = 'hero-posts-item-post-post-data-style-' . $array['post_data_style'] ;
	$class[] = 'hero-posts-item-align-' . $array['align'] ;
	
	// $class[] = 'hero-posts-item-title-font-size-' . $array['title_size'] ;
	BTBB_Light::responsive_data_override_class(
		$class, $data_override_class,
		array(
			'prefix' => 'hero-posts-item-',
			'suffix' => '-',
			'param' =>  'title-font-size',
			'value' =>  $array['title_size']
		)
	);
	// $class[] = 'hero-posts-item-image-position-' . $array['image_position'] ;
	BTBB_Light::responsive_data_override_class(
		$class, $data_override_class,
		array(
			'prefix' => 'hero-posts-item-',
			'suffix' => '-',
			'param' =>  'image-position',
			'value' =>  $array['image_position']
		)
	);
	// $class[] = 'hero-posts-item-show-excerpt-' . $array['show_excerpt'] ;
	BTBB_Light::responsive_data_override_class(
		$class, $data_override_class,
		array(
			'prefix' => 'hero-posts-item-',
			'suffix' => '-',
			'param' =>  'show-excerpt',
			'value' =>  $array['show_excerpt']
		)
	);
	// $class[] = 'hero-posts-item-title-max-lines-' . $array['title_max_lines'] ;
	BTBB_Light::responsive_data_override_class(
		$class, $data_override_class,
		array(
			'prefix' => 'hero-posts-item-',
			'suffix' => '-',
			'param' =>  'title-max-lines',
			'value' =>  $array['title_max_lines']
		)
	);
	
	/* ----------- */
	/* -- Style -- */
	/* ----------- */
	
	$style[] = '--hero-posts-item-content-vertical-align: ' . $array['vertical_align'];
	$style[] = '--hero-posts-item-align: ' . $array['align'];
	$style[] = '--hero-posts-item-image-border-radius: ' . $array['image_border_radius'];
	if ( $array['image_overlay_background_gradient_type'] != 'none' ) {
		$gradient_type_arr = explode( "-", $array['image_overlay_background_gradient_type'] );
		if( $gradient_type_arr[0] == 'linear'  ) {
			$style[] = '--hero-posts-item-image-overlay-background-color: linear-gradient(to ' . $gradient_type_arr[1] . ', var(--hero-posts-' . $array['image_overlay_background_gradient_start'] . '), var(--hero-posts-' . $array['image_overlay_background_gradient_end'] . '))' ;		
		} else  {
			$style[] = '--hero-posts-item-image-overlay-background-color: radial-gradient(circle, var(--hero-posts-' . $array['image_overlay_background_gradient_start'] . '), var(--hero-posts-' . $array['image_overlay_background_gradient_end'] . '))' ;
		}		
	}
	$style[] = '--hero-posts-item-image-overlay-hover-opacity-from: ' . ( $array['image_overlay_hover_opacity_from'] / 100 );
	$style[] = '--hero-posts-item-image-overlay-hover-opacity-to: ' . ( $array['image_overlay_hover_opacity_to'] / 100 );
	
	$style[] = '--hero-posts-item-image-hover-blur-from: ' . ( $array['image_hover_blur_from'] );
	$style[] = '--hero-posts-item-image-hover-blur-to: ' . ( $array['image_hover_blur_to'] );
	
	$array['image_hover_zoom_to'] = ( $array['image_hover_zoom_to'] == '1' && $array['image_hover_zoom_from'] != '1' ) ? '1.001' : $array['image_hover_zoom_to'];  
	$array['image_hover_zoom_from'] = ( $array['image_hover_zoom_from'] == '1' && $array['image_hover_zoom_to'] != '1' ) ? '1.001' : $array['image_hover_zoom_from'];  
	$style[] = '--hero-posts-item-image-hover-zoom-from: ' . ( $array['image_hover_zoom_from'] );
	$style[] = '--hero-posts-item-image-hover-zoom-to: ' . ( $array['image_hover_zoom_to'] );
	
	$style[] = '--hero-posts-item-image-hover-move-content: ' . ( $array['image_hover_move_content'] );
	
	if( $array['content_text_color'] != "" ) 			$style[] = '--hero-posts-item-content-color: ' . ( $array['content_text_color'] );
	if( $array['content_background_color'] != "" ) 		$style[] = '--hero-posts-item-content-background-color: ' . ( $array['content_background_color'] );



	
	/* ------------ */
	/* -- Custom -- */
	/* ------------ */
	
	$class[] = $array['custom_class'];
	$style[] = trim( preg_replace( '/\s+/', ' ', $array['custom_style'] ));
	$id = $array['custom_id'];
	
	/* ------------ */
	/* -- Output -- */
	/* ------------ */
	
	$output = '';
	
	$output_permalink 			= $post->permalink;
	$output_featured_image 		= $post->featured_image;
	
	$output_top_left 			= self::get_formatted_post_data( $array['show_top_left'], $post );
	$output_top_right 			= self::get_formatted_post_data( $array['show_top_right'], $post );
	
	$output_supertitle 			= self::get_formatted_post_data( $array['show_supertitle'], $post );
	$output_title 				= self::get_formatted_post_data( $array['show_title'], $post );
	$output_excerpt 			= $post->post_excerpt;
	$output_subtitle 			= self::get_formatted_post_data( $array['show_subtitle'], $post );
	
	$output_bottom_left 		= self::get_formatted_post_data( $array['show_bottom_left'], $post );
	$output_bottom_right 		= self::get_formatted_post_data( $array['show_bottom_right'], $post );
	
	$output_image_top_left 		= self::get_formatted_post_data( $array['show_image_top_left'], $post );
	$output_image_top_right 	= self::get_formatted_post_data( $array['show_image_top_right'], $post );
	
	$output_image_center 		= self::get_formatted_post_data( $array['show_image_center'], $post );
	
	$output_image_bottom_left 	= self::get_formatted_post_data( $array['show_image_bottom_left'], $post );
	$output_image_bottom_right 	= self::get_formatted_post_data( $array['show_image_bottom_right'], $post );
	
	if ( $post ) {
		// $class = array_merge( $class, $post->css_class );
		$output .= '<div class="' . esc_attr( implode( ' ', $class ) ) . '" style="' . esc_attr( implode( '; ', $style ) ) . '" id="' . esc_attr( $id ) . '" data-btbbl-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '" data-btbbl-override-style-var="' . htmlspecialchars( json_encode( $data_override_style_var, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '">';
			$output .= '<div class="hero-posts-item-image">';		
				$output .= '<div class="hero-posts-item-image-inner">';		
					$output .= '<div class="hero-posts-item-image-container">';			
						$output .= '<a class="hero-posts-item-image-a" href="' . $output_permalink . '">';			
							$output .= $array['image_lazy_load'] == 'yes' ? $output_featured_image : str_replace( "loading=\"lazy\"", "", $output_featured_image );		
						$output .= '</a>';
					$output .= '</div>';
					$output .= '<div class="hero-posts-item-image-content">';
						if ( $output_image_top_left != "" || $output_image_top_right != ""  ) {
							$output .= '<div class="hero-posts-item-image-content-top">';
								$output .= '<div class="hero-posts-item-image-content-top-left">' . $output_image_top_left . '</div>'; 
								$output .= '<div class="hero-posts-item-image-content-top-right">' . $output_image_top_right . '</div>'; 
							$output .= '</div>';						
						}
						$output .= '<div class="hero-posts-item-image-content-middle">';
							$output .= '<div class="hero-posts-item-image-content-middle-inner">';
								$output .= '<div>' . $output_image_center . '</div>'; 
							$output .= '</div>';
						$output .= '</div>';
						if ( $output_image_bottom_left != "" || $output_image_bottom_right != ""  ) {
							$output .= '<div class="hero-posts-item-image-content-bottom">';
								$output .= '<div class="hero-posts-item-image-content-bottom-left">' . $output_image_bottom_left . '</div>'; 
								$output .= '<div class="hero-posts-item-image-content-bottom-right">' . $output_image_bottom_right . '</div>'; 
							$output .= '</div>';						
						}
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="hero-posts-item-content">';
				$output .= '<div class="hero-posts-item-content-inner">';
					if ( $output_top_left != "" || $output_top_right != ""  ) {
						$output .= '<div class="hero-posts-item-content-top">';
							$output .= '<div class="hero-posts-item-content-top-left">' . $output_top_left . '</div>'; 
							$output .= '<div class="hero-posts-item-content-top-right">' . $output_top_right . '</div>'; 
						$output .= '</div>'; 					
					}
					$output .= '<div class="hero-posts-item-content-middle">';
						$output .= '<div class="hero-posts-item-content-middle-inner">';
							if ( $output_supertitle != "" ) $output .= '<p class="hero-posts-item-content-supertitle"><span class="hero-posts-item-content-supertitle-inner">' . $output_supertitle . '</span></p>';
							if ( $output_title != "" ) 		$output .= '<' . $array['title_tag'] . ' class="hero-posts-item-content-title"><span class="hero-posts-item-content-title-inner">' . $output_title  . '</span></' . $array['title_tag'] . '>';
							if ( $output_subtitle != "" ) 	$output .= '<p class="hero-posts-item-content-subtitle"><span class="hero-posts-item-content-subtitle-inner">' . $output_subtitle  . '</span></p>';	 
							if ( $output_excerpt != "" ) 	$output .= '<p class="hero-posts-item-content-excerpt"><span class="hero-posts-item-content-excerpt-inner">' . $output_excerpt . '</span></p>';	 
						$output .= '</div>'; 
					$output .= '</div>'; 
					if ( $output_bottom_left != "" || $output_bottom_right != ""  ) {
						$output .= '<div class="hero-posts-item-content-bottom">';
							$output .= '<div class="hero-posts-item-content-bottom-left">' . $output_bottom_left . '</div>'; 
							$output .= '<div class="hero-posts-item-content-bottom-right">' . $output_bottom_right . '</div>';
						$output .= '</div>';					
					}
				$output .= '</div>';			
			$output .= '</div>';			
		$output .= '</div>';
	}
	
	return $output;
?>