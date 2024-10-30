<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
class Hero_Posts_Item extends Hero_Posts_Base {
	
	static function init() {
		add_shortcode( 'hero_posts_item', array( __CLASS__, 'handle_shortcode' ) );
	}

	static function handle_shortcode( $atts, $content ) {
		extract( 
			shortcode_atts( 
				array(
					/* Content */
					'align'     										=> 'inherit',
					'vertical_align'     								=> 'center',
					'title_tag'   										=> 'h3',
					'title_size'   										=> 'inherit',
					
					/* Show in */
					'show_excerpt'     									=> 'hide',
					'show_top_left'     								=> '',
					'show_top_right'     								=> '',
					'show_supertitle'     								=> 'date',
					'show_title'     									=> 'title',
					'show_subtitle'     								=> '',
					'show_bottom_left'     								=> '',
					'show_bottom_right'     							=> '',
					'show_image_top_left'   							=> '',
					'show_image_top_right'     							=> '',
					'show_image_center'     							=> '',
					'show_image_bottom_left'    						=> '',
					'show_image_bottom_right'   						=> '',
					
					/* Formating */
					'title_max_lines'									=> 'all',
					'content_text_color'								=> '',
					'content_background_color'							=> '',
					'post_format_icons'									=> 'extended-media',
					'post_data_style'									=> 'clean-icon',
					'categories_style'									=> 'pills',
					
					/* Image */
					'image_position'   									=> 'background',
					'image_size'   										=> 'full',
					'image_lazy_load'   								=> '',
					'image_border_radius'   							=> '0',
					'image_overlay_background_gradient_type'   			=> 'linear-top',
					'image_overlay_background_gradient_start'   		=> 'dark-color-80',
					'image_overlay_background_gradient_end'   			=> 'dark-color-10',
					
					/* Hover */
					'image_overlay_hover_opacity_from' 					=> '100',
					'image_overlay_hover_opacity_to' 					=> '50',
					
					/* Blur */
					'image_hover_blur_from' 					        => '0px',
					'image_hover_blur_to' 					            => '0px',

					/* Zoom */
			        'image_hover_zoom_from'                             => '1.1',
					'image_hover_zoom_to'                               => '1',

					/* Move content */   
					'image_hover_move_content'                          => '0',                       

					/* Custom */
					'custom_id'   										=> '',
					'custom_class'   									=> '',
					'custom_style'   									=> '',
				), 
				$atts, 
				'hero_posts_item' 
			) 
		);

		$parts = self::get_content_parts( $content );
		
		$custom_id = $custom_id != '' ? $custom_id : uniqid( 'hero-posts-item-' );
		
		$my_data = array(
			'iden' 												=> 'hero_posts_item',
			
			/* Content */
			'align' 											=> $align,
			'vertical_align' 									=> $vertical_align,
			'title_tag' 										=> $title_tag,
			'title_size' 										=> $title_size,
			
			/* Show in */
			'show_excerpt' 										=> $show_excerpt,
			'show_top_left' 									=> $show_top_left,
			'show_top_right' 									=> $show_top_right,
			'show_supertitle' 									=> $show_supertitle,
			'show_title' 										=> $show_title,
			'show_subtitle' 									=> $show_subtitle,
			'show_bottom_left' 									=> $show_bottom_left,
			'show_bottom_right' 								=> $show_bottom_right,
			'show_image_top_left' 								=> $show_image_top_left,
			'show_image_top_right' 								=> $show_image_top_right,
			'show_image_center' 								=> $show_image_center,
			'show_image_bottom_left' 							=> $show_image_bottom_left,
			'show_image_bottom_right' 							=> $show_image_bottom_right,
			
			/* Formating */
			'title_max_lines' 									=> $title_max_lines,
			'content_text_color' 								=> $content_text_color,
			'content_background_color' 							=> $content_background_color,
			'post_format_icons' 								=> $post_format_icons,
			'post_data_style' 									=> $post_data_style,
			'categories_style' 									=> $categories_style,
			
			/* Image */
			'image_position' 									=> $image_position,
			'image_size' 										=> $image_size,
			'image_lazy_load' 									=> $image_lazy_load,
			'image_border_radius' 								=> $image_border_radius,
			'image_overlay_background_gradient_type' 			=> $image_overlay_background_gradient_type,
			'image_overlay_background_gradient_start' 			=> $image_overlay_background_gradient_start,
			'image_overlay_background_gradient_end' 			=> $image_overlay_background_gradient_end,
			
			/* Hover */
			'image_overlay_hover_opacity_from' 					=> $image_overlay_hover_opacity_from,
			'image_overlay_hover_opacity_to' 					=> $image_overlay_hover_opacity_to,

			/* Blur */
			'image_hover_blur_from' 					        => $image_hover_blur_from,
			'image_hover_blur_to' 					            => $image_hover_blur_to,

			/* Zoom */
			'image_hover_zoom_from' 					        => $image_hover_zoom_from,
			'image_hover_zoom_to' 					            => $image_hover_zoom_to,

			/* Move content */
			'image_hover_move_content'                          => $image_hover_move_content,
			
			/* Custom */
			'custom_id' 										=> $custom_id,
			'custom_class' 										=> $custom_class,
			'custom_style' 										=> $custom_style,
			
			/* Content */
			'content' 											=> $parts,
		);
		return serialize( $my_data ) . self::get_delimiter();
	}
}

Hero_Posts_Item::init();


// Map shortcode

function hero_posts_item_map() {
	
	$params = array(
		array( 
			'param_name' 		=> 'align', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'inherit', 
			'heading' 			=> esc_html__( 'Content align', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'Inherit', 'hero-posts' ) 				=> 'inherit',
				esc_html__( 'Left', 'hero-posts' ) 					=> 'left',
				esc_html__( 'Right', 'hero-posts' ) 				=> 'right',
				esc_html__( 'Center', 'hero-posts' ) 				=> 'center'
			)
		),
		array( 
			'param_name' 		=> 'vertical_align', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'center', 
			'heading' 			=> esc_html__( 'Content vertical align', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'Top', 'hero-posts' ) 					=> 'flex-start',
				esc_html__( 'Center', 'hero-posts' ) 				=> 'center',
				esc_html__( 'Bottom', 'hero-posts' ) 				=> 'flex-end'
			)
		),
		array( 
			'param_name' 		=> 'title_tag', 
			'type' 				=> 'dropdown', 
			'default' 			=> 'h3', 
			'heading' 			=> esc_html__( 'Title tag', 'hero-posts' ), 
			'preview' 			=> true,
			'value' 			=> array(
				esc_html__( 'H1', 'hero-posts' ) 					=> 'h1',
				esc_html__( 'H2', 'hero-posts' ) 					=> 'h2',
				esc_html__( 'H3', 'hero-posts' ) 					=> 'h3',
				esc_html__( 'H4', 'hero-posts' ) 					=> 'h4',
				esc_html__( 'H5', 'hero-posts' ) 					=> 'h5',
				esc_html__( 'H6', 'hero-posts' ) 					=> 'h6',
				esc_html__( 'p', 'hero-posts' ) 					=> 'p',
			)
		),
		array( 
			'param_name' 			=> 'title_size',  
			'responsive_override' 	=> true,
			'type' 					=> 'dropdown', 
			'default' 				=> 'inherit', 
			'heading' 				=> esc_html__( 'Title size', 'hero-posts' ), 
			'description' 			=> esc_html__( 'Title size defines title sizes fot subtitle, title and supertitle. Check docmantation if you want to shange specific element.', 'hero-posts' ), 
			'preview' 				=> true,
			'value' 				=> array(
				esc_html__( 'Inherit', 'hero-posts' ) 				=> 'inherit',
				esc_html__( 'Extra small', 'hero-posts' ) 			=> 'extra-small',
				esc_html__( 'Small', 'hero-posts' ) 				=> 'small',
				esc_html__( 'Normal', 'hero-posts' ) 				=> 'normal',
				esc_html__( 'Medium', 'hero-posts' ) 				=> 'medium',
				esc_html__( 'Large', 'hero-posts' ) 				=> 'large',
				esc_html__( 'Extra large', 'hero-posts' ) 			=> 'extra-large',
				esc_html__( 'Huge', 'hero-posts' ) 					=> 'huge',
				esc_html__( 'Extra huge', 'hero-posts' ) 			=> 'extra-huge',
			)
		),
		array( 
			'param_name' 			=> 'show_excerpt',  
			'responsive_override' 	=> true,
			'type' 					=> 'dropdown', 
			'group' 				=> esc_html__( 'Show in', 'hero-posts' ),
			'default' 				=> 'background', 
			'heading' 				=> esc_html__( 'Excerpt', 'hero-posts' ), 
			'preview' 				=> true,
			'value' 				=> array(
				esc_html__( 'Hide', 'hero-posts' ) 					=> 'hide',
				esc_html__( 'Show all', 'hero-posts' ) 				=> 'all',
				esc_html__( 'Max 1 line', 'hero-posts' ) 			=> '1-line',
				esc_html__( 'Max 2 lines', 'hero-posts' ) 			=> '2-lines',
				esc_html__( 'Max 3 lines', 'hero-posts' ) 			=> '3-lines',
				esc_html__( 'Max 4 lines', 'hero-posts' ) 			=> '4-lines',
				esc_html__( 'Max 5 lines', 'hero-posts' ) 			=> '5-lines',
				esc_html__( 'Fixed 2 line', 'hero-posts' ) 			=> '2-line-fix',
				esc_html__( 'Fixed 2 lines', 'hero-posts' ) 		=> '2-lines-fix',
				esc_html__( 'Fixed 3 lines', 'hero-posts' ) 		=> '3-lines-fix',
				esc_html__( 'Fixed 4 lines', 'hero-posts' ) 		=> '4-lines-fix',
				esc_html__( 'Fixed 5 lines', 'hero-posts' ) 		=> '5-lines-fix',
			)
		),
		array( 
			'param_name' 		=> 'show_top_left', 
			'type' 				=> 'checkbox_group', 
			'group' 			=> esc_html__( 'Show in', 'hero-posts' ), 
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Top left corner', 'hero-posts' ), 
			'value' 			=> hero_posts_get_post_elements()
		),
		array( 
			'param_name' 		=> 'show_top_right', 
			'type' 				=> 'checkbox_group', 
			'group' 			=> esc_html__( 'Show in', 'hero-posts' ), 
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Top right corner', 'hero-posts' ), 
			'value' 			=> hero_posts_get_post_elements()
		),
		array( 
			'param_name' 		=> 'show_supertitle', 
			'type' 				=> 'checkbox_group', 
			'group' 			=> esc_html__( 'Show in', 'hero-posts' ), 
			'default' 			=> 'date', 
			'heading' 			=> esc_html__( 'Supertitle', 'hero-posts' ), 
			'value' 			=> hero_posts_get_post_elements()
		),
		array( 
			'param_name' 		=> 'show_title', 
			'type' 				=> 'checkbox_group',  
			'group' 			=> esc_html__( 'Show in', 'hero-posts' ), 
			'default' 			=> 'title', 
			'heading' 			=> esc_html__( 'Title', 'hero-posts' ), 
			'value' 			=> hero_posts_get_post_elements()
		),
		array( 
			'param_name' 		=> 'show_subtitle', 
			'type' 				=> 'checkbox_group', 
			'group' 			=> esc_html__( 'Show in', 'hero-posts' ), 
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Subtitle', 'hero-posts' ), 
			'value' 			=> hero_posts_get_post_elements()
		),
		array( 
			'param_name' 		=> 'show_bottom_left', 
			'type' 				=> 'checkbox_group', 
			'group' 			=> esc_html__( 'Show in', 'hero-posts' ), 
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Bottom left corner', 'hero-posts' ), 
			'value' 			=> hero_posts_get_post_elements()
		),
		array( 
			'param_name' 		=> 'show_bottom_right', 
			'type' 				=> 'checkbox_group', 
			'group' 			=> esc_html__( 'Show in', 'hero-posts' ), 
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Bottom right corner', 'hero-posts' ), 
			'value' 			=> hero_posts_get_post_elements()
		),
		array( 
			'param_name' 		=> 'show_image_top_left', 
			'type' 				=> 'checkbox_group', 
			'group' 			=> esc_html__( 'Show in', 'hero-posts' ), 
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Image top left corner', 'hero-posts' ), 
			'value' 			=> hero_posts_get_post_elements()
		),
		array( 
			'param_name' 		=> 'show_image_top_right', 
			'type' 				=> 'checkbox_group', 
			'group' 			=> esc_html__( 'Show in', 'hero-posts' ), 
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Image top right corner', 'hero-posts' ), 
			'value' 			=> hero_posts_get_post_elements()
		),
		array( 
			'param_name' 		=> 'show_image_center', 
			'type' 				=> 'checkbox_group', 
			'group' 			=> esc_html__( 'Show in', 'hero-posts' ), 
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Image center', 'hero-posts' ), 
			'value' 			=> hero_posts_get_post_elements()
		),
		array( 
			'param_name' 		=> 'show_image_bottom_left', 
			'type' 				=> 'checkbox_group', 
			'group' 			=> esc_html__( 'Show in', 'hero-posts' ), 
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Image bottom left corner', 'hero-posts' ), 
			'value' 			=> hero_posts_get_post_elements()
		),
		array( 
			'param_name' 		=> 'show_image_bottom_right', 
			'type' 				=> 'checkbox_group', 
			'group' 			=> esc_html__( 'Show in', 'hero-posts' ), 
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Image bottom right corner', 'hero-posts' ), 
			'value' 			=> hero_posts_get_post_elements()
		),
		array( 
			'param_name' 			=> 'title_max_lines',   
			'responsive_override' 	=> true, 
			'type' 					=> 'dropdown', 
			'group' 				=> esc_html__( 'Formatting', 'hero-posts' ),
			'default' 				=> 'background', 
			'heading' 				=> esc_html__( 'Max lines in title', 'hero-posts' ), 
			'value' 				=> array(
				esc_html__( 'Show all', 'hero-posts' ) 					=> 'all',
				esc_html__( 'Max 1 line', 'hero-posts' ) 				=> '1-line',
				esc_html__( 'Max 2 lines', 'hero-posts' ) 				=> '2-lines',
				esc_html__( 'Max 3 lines', 'hero-posts' ) 				=> '3-lines',
				esc_html__( 'Max 4 lines', 'hero-posts' ) 				=> '4-lines',
				esc_html__( 'Max 5 lines', 'hero-posts' ) 				=> '5-lines',
				esc_html__( 'Fixed 1 line', 'hero-posts' ) 				=> '1-line-fix',
				esc_html__( 'Fixed 2 lines', 'hero-posts' ) 			=> '2-lines-fix',
				esc_html__( 'Fixed 3 lines', 'hero-posts' ) 			=> '3-lines-fix',
				esc_html__( 'Fixed 4 lines', 'hero-posts' ) 			=> '4-lines-fix',
				esc_html__( 'Fixed 5 lines', 'hero-posts' ) 			=> '5-lines-fix',
			)
		),
		array( 
			'param_name' 			=> 'content_text_color',   
			'type' 					=> 'colorpicker', 
			'group' 				=> esc_html__( 'Formatting', 'hero-posts' ),
			'default' 				=> '', 
			'heading' 				=> esc_html__( 'Content text color', 'hero-posts' ),
		),
		array( 
			'param_name' 			=> 'content_background_color',   
			'type' 					=> 'colorpicker', 
			'group' 				=> esc_html__( 'Formatting', 'hero-posts' ),
			'default' 				=> '', 
			'heading' 				=> esc_html__( 'Content text background color', 'hero-posts' ),
		),
		array( 
			'param_name' 			=> 'post_data_style',   
			'type' 					=> 'dropdown', 
			'group' 				=> esc_html__( 'Formatting', 'hero-posts' ),
			'default' 				=> 'clean-icon', 
			'heading' 				=> esc_html__( 'Post data style', 'hero-posts' ), 
			'value' 				=> array(
				esc_html__( 'Clean with icon', 'hero-posts' ) 										=> 'clean-icon',
				esc_html__( 'Clean without icon', 'hero-posts' ) 									=> 'clean',
			)
		),
		array( 
			'param_name' 			=> 'post_format_icons',   
			'type' 					=> 'dropdown', 
			'group' 				=> esc_html__( 'Formatting', 'hero-posts' ),
			'default' 				=> 'all', 
			'heading' 				=> esc_html__( 'Post format icons options', 'hero-posts' ), 
			'value' 				=> array(
				esc_html__( 'All icons', 'hero-posts' ) 											=> 'all',
				esc_html__( 'Basic media (audio, video)', 'hero-posts' ) 							=> 'all-media',
				esc_html__( 'Extended media (basic + photo, gallery)', 'hero-posts' ) 				=> 'extended-media',
				esc_html__( 'All except standard (extended + chat, quote, link)', 'hero-posts' ) 	=> 'all-no-standard',
			)
		),
		array( 
			'param_name' 			=> 'categories_style',   
			'type' 					=> 'dropdown', 
			'group' 				=> esc_html__( 'Formatting', 'hero-posts' ),
			'default' 				=> 'pills', 
			'heading' 				=> esc_html__( 'Categories style', 'hero-posts' ), 
			'value' 				=> array(
				esc_html__( 'Clean', 'hero-posts' ) 												=> 'clean',
				esc_html__( 'Clean (accent color)', 'hero-posts' ) 									=> 'clean-accent',
				esc_html__( 'Clean with icon', 'hero-posts' ) 										=> 'clean-icon',
				esc_html__( 'Clean with icon (accent color)', 'hero-posts' ) 						=> 'clean-accent-icon',
				esc_html__( 'Pills', 'hero-posts' ) 												=> 'pills',
				esc_html__( 'Pills & icon', 'hero-posts' ) 											=> 'pills-icon',
			)
		),
		array( 
			'param_name' 			=> 'image_position',   
			'responsive_override' 	=> true,
			'type' 					=> 'dropdown', 
			'group' 				=> esc_html__( 'Image', 'hero-posts' ),
			'default' 				=> 'background', 
			'heading' 				=> esc_html__( 'Image position', 'hero-posts' ), 
			'description' 			=> esc_html__( 'Add --hero-posts-item-side-image-width: 50%; to change image width (if left or right position is active)', 'hero-posts' ), 
			'preview' 				=> true,
			'value' 				=> array(
				esc_html__( 'Background', 'hero-posts' ) 					=> 'background',
				esc_html__( 'Top', 'hero-posts' ) 							=> 'top',
				esc_html__( 'Bottom', 'hero-posts' ) 						=> 'bottom',
				esc_html__( 'Left', 'hero-posts' ) 							=> 'left',
				esc_html__( 'Left and keep aspect ratio', 'hero-posts' ) 	=> 'left-keep-aspect-ratio',
				esc_html__( 'Right', 'hero-posts' ) 						=> 'right',
				esc_html__( 'Right and keep aspect ratio', 'hero-posts' ) 	=> 'right-keep-aspect-ratio',
				esc_html__( 'Hidden', 'hero-posts' ) 						=> 'hidden',
			)
		),
		array( 
			'param_name' 		=> 'image_size', 
			'type' 				=> 'dropdown', 
			'group' 			=> esc_html__( 'Image', 'hero-posts' ),
			'default' 			=> 'full', 
			'heading' 			=> esc_html__( 'Base image size', 'hero-posts' ), 
			'value' 			=> hero_posts_get_image_sizes()
		),
		array( 
			'param_name' 		=> 'image_lazy_load', 
			'type' 				=> 'checkbox', 
			'group' 			=> esc_html__( 'Image', 'hero-posts' ),
			'default' 			=> 'yes', 
			'heading' 			=> esc_html__( 'Lazy load images', 'hero-posts' ),
			'value' 			=> array( 
				esc_html__( 'Yes', 'bold-builder' ) 						=> 'yes',
			)
		),
		array( 
			'param_name' 		=> 'image_border_radius', 
			'type' 				=> 'dropdown', 
			'group' 			=> esc_html__( 'Image', 'hero-posts' ),
			'default' 			=> 'full', 
			'heading' 			=> esc_html__( 'Image border radius', 'hero-posts' ), 
			'value' 			=> hero_posts_get_border_radiuses()
		),
		array( 
			'param_name' 		=> 'image_overlay_background_gradient_type', 
			'type' 				=> 'dropdown', 
			'group' 			=> esc_html__( 'Image', 'hero-posts' ),
			'default' 			=> 'linear-top', 
			'heading' 			=> esc_html__( 'Image overlay background type', 'hero-posts' ), 
			'value' 			=> array(
				esc_html__( 'No overlay', 'hero-posts' ) 						=> 'none',
				esc_html__( 'Linear from bottom to top', 'hero-posts' ) 		=> 'linear-top',
				esc_html__( 'Linear from top to bottom', 'hero-posts' ) 		=> 'linear-bottom',
				esc_html__( 'Linear from left to right', 'hero-posts' ) 		=> 'linear-right',
				esc_html__( 'Linear from right to left', 'hero-posts' ) 		=> 'linear-left',
				esc_html__( 'Radial from center', 'hero-posts' ) 				=> 'radial-center',
			)
		),
		array( 
			'param_name' 		=> 'image_overlay_background_gradient_start', 
			'type' 				=> 'dropdown', 
			'group' 			=> esc_html__( 'Image', 'hero-posts' ),
			'default' 			=> 'dark-color-80', 
			'heading' 			=> esc_html__( 'Start color', 'hero-posts' ), 
			'value' 			=> hero_posts_get_overlay_background_colors()
		),
		array( 
			'param_name' 		=> 'image_overlay_background_gradient_end', 
			'type' 				=> 'dropdown', 
			'group' 			=> esc_html__( 'Image', 'hero-posts' ),
			'default' 			=> 'dark-color-10', 
			'heading' 			=> esc_html__( 'End color', 'hero-posts' ), 
			'value' 			=> hero_posts_get_overlay_background_colors()
		),
		/* Hover */
		array( 
			'param_name' 		=> 'image_overlay_hover_opacity_from', 
			'type' 				=> 'dropdown', 
			'group' 			=> esc_html__( 'Hover', 'hero-posts' ),
			'default' 			=> '100', 
			'heading' 			=> esc_html__( 'Image overlay opacity from', 'hero-posts' ), 
			'value' 			=> hero_posts_get_overlay_opacities()
		),
		array( 
			'param_name' 		=> 'image_overlay_hover_opacity_to', 
			'type' 				=> 'dropdown', 
			'group' 			=> esc_html__( 'Hover', 'hero-posts' ),
			'default' 			=> '50', 
			'heading' 			=> esc_html__( 'Image overlay opacity to', 'hero-posts' ), 
			'value' 			=> hero_posts_get_overlay_opacities()
		),
		/* Blur */
		array( 
			'param_name' 		=> 'image_hover_blur_from', 
			'type' 				=> 'dropdown', 
			'group' 			=> esc_html__( 'Hover', 'hero-posts' ),
			'default' 			=> '0px', 
			'heading' 			=> esc_html__( 'Image blur from', 'hero-posts' ), 
			'value' 			=> array(
				esc_html__( '0px', 'hero-posts' ) 				=> '0px',
				esc_html__( '1px', 'hero-posts' ) 				=> '1px',
				esc_html__( '2px', 'hero-posts' ) 				=> '2px',
				esc_html__( '3px', 'hero-posts' ) 				=> '3px',
				esc_html__( '4px', 'hero-posts' ) 				=> '4px',
				esc_html__( '5px', 'hero-posts' ) 				=> '5px',
				esc_html__( '6px', 'hero-posts' ) 				=> '6px',
				esc_html__( '7px', 'hero-posts' ) 				=> '7px',
				esc_html__( '8px', 'hero-posts' ) 				=> '8px',
				esc_html__( '9px', 'hero-posts' ) 				=> '9px',
				esc_html__( '10px', 'hero-posts' ) 				=> '10px'
			)
		),
		array( 
			'param_name' 		=> 'image_hover_blur_to', 
			'type' 				=> 'dropdown', 
			'group' 			=> esc_html__( 'Hover', 'hero-posts' ),
			'default' 			=> '0px', 
			'heading' 			=> esc_html__( 'Image blur to', 'hero-posts' ), 
			'value' 			=> array(
				esc_html__( '0px', 'hero-posts' ) 				=> '0px',
				esc_html__( '1px', 'hero-posts' ) 				=> '1px',
				esc_html__( '2px', 'hero-posts' ) 				=> '2px',
				esc_html__( '3px', 'hero-posts' ) 				=> '3px',
				esc_html__( '4px', 'hero-posts' ) 				=> '4px',
				esc_html__( '5px', 'hero-posts' ) 				=> '5px',
				esc_html__( '6px', 'hero-posts' ) 				=> '6px',
				esc_html__( '7px', 'hero-posts' ) 				=> '7px',
				esc_html__( '8px', 'hero-posts' ) 				=> '8px',
				esc_html__( '9px', 'hero-posts' ) 				=> '9px',
				esc_html__( '10px', 'hero-posts' ) 				=> '10px'
			)
		),
		/* Zoom */
		array( 
			'param_name' 		=> 'image_hover_zoom_from', 
			'type' 				=> 'dropdown', 
			'group' 			=> esc_html__( 'Hover', 'hero-posts' ),
			'default' 			=> '1.1', 
			'heading' 			=> esc_html__( 'Image zoom from', 'hero-posts' ), 
			'value' 			=> array(
				esc_html__( '1', 'hero-posts' ) 				=> '1',
				esc_html__( '1.1', 'hero-posts' ) 				=> '1.1',
				esc_html__( '1.2', 'hero-posts' ) 				=> '1.2',
				esc_html__( '1.3', 'hero-posts' ) 				=> '1.3',
				esc_html__( '1.4', 'hero-posts' ) 				=> '1.4',
				esc_html__( '1.5', 'hero-posts' ) 				=> '1.5',
				esc_html__( '1.6', 'hero-posts' ) 				=> '1.6',
				esc_html__( '1.7', 'hero-posts' ) 				=> '1.7',
				esc_html__( '1.8', 'hero-posts' ) 				=> '1.8',
				esc_html__( '1.9', 'hero-posts' ) 				=> '1.9',
				esc_html__( '2.0', 'hero-posts' ) 				=> '2.0'
			)
		),
		array( 
			'param_name' 		=> 'image_hover_zoom_to', 
			'type' 				=> 'dropdown', 
			'group' 			=> esc_html__( 'Hover', 'hero-posts' ),
			'default' 			=> '1', 
			'heading' 			=> esc_html__( 'Image zoom to', 'hero-posts' ), 
			'value' 			=> array(
				esc_html__( '1', 'hero-posts' ) 				=> '1',
				esc_html__( '1.1', 'hero-posts' ) 				=> '1.1',
				esc_html__( '1.2', 'hero-posts' ) 				=> '1.2',
				esc_html__( '1.3', 'hero-posts' ) 				=> '1.3',
				esc_html__( '1.4', 'hero-posts' ) 				=> '1.4',
				esc_html__( '1.5', 'hero-posts' ) 				=> '1.5',
				esc_html__( '1.6', 'hero-posts' ) 				=> '1.6',
				esc_html__( '1.7', 'hero-posts' ) 				=> '1.7',
				esc_html__( '1.8', 'hero-posts' ) 				=> '1.8',
				esc_html__( '1.9', 'hero-posts' ) 				=> '1.9',
				esc_html__( '2.0', 'hero-posts' ) 				=> '2.0'
			)
		),
		/* Move content */
 		array( 
			'param_name' 		=> 'image_hover_move_content', 
			'type' 				=> 'dropdown', 
			'group' 			=> esc_html__( 'Hover', 'hero-posts' ),
			'default' 			=> '0', 
			'heading' 			=> esc_html__( 'Move content by', 'hero-posts' ), 
			'value' 			=> array(
			    esc_html__( '0px', 'hero-posts' ) 					=> '0px',
			    esc_html__( '-20px', 'hero-posts' ) 				=> '-20px',
				esc_html__( '-19px', 'hero-posts' ) 				=> '-19px',
				esc_html__( '-18px', 'hero-posts' ) 				=> '-18px',
				esc_html__( '-17px', 'hero-posts' ) 				=> '-17px',
				esc_html__( '-16px', 'hero-posts' ) 				=> '-16px',
				esc_html__( '-15px', 'hero-posts' ) 				=> '-15px',
				esc_html__( '-14px', 'hero-posts' ) 				=> '-14px',
				esc_html__( '-13px', 'hero-posts' ) 				=> '-13px',
				esc_html__( '-12px', 'hero-posts' ) 				=> '-12px',
				esc_html__( '-11px', 'hero-posts' ) 				=> '-11px',
				esc_html__( '-10px', 'hero-posts')   				=> '-10px',
				esc_html__( '-9px', 'hero-posts' ) 					=> '-9px',
				esc_html__( '-8px', 'hero-posts' ) 					=> '-8px',
				esc_html__( '-7px', 'hero-posts' ) 					=> '-7px',
				esc_html__( '-6px', 'hero-posts' ) 					=> '-6px',
				esc_html__( '-5px', 'hero-posts' ) 					=> '-5px',
				esc_html__( '-4px', 'hero-posts' ) 					=> '-4px',
				esc_html__( '-3px', 'hero-posts' ) 					=> '-3px',
				esc_html__( '-2px', 'hero-posts' ) 					=> '-2px',
				esc_html__( '-1px', 'hero-posts' ) 					=> '-1px',
				
				esc_html__( '1px', 'hero-posts' ) 					=> '1px',
				esc_html__( '2px', 'hero-posts' ) 					=> '2px',
				esc_html__( '3px', 'hero-posts' ) 					=> '3px',
				esc_html__( '4px', 'hero-posts' ) 					=> '4px',
				esc_html__( '5px', 'hero-posts' ) 					=> '5px',
				esc_html__( '6px', 'hero-posts' ) 					=> '6px',
				esc_html__( '7px', 'hero-posts' ) 					=> '7px',
				esc_html__( '8px', 'hero-posts' ) 					=> '8px',
				esc_html__( '9px', 'hero-posts' ) 					=> '9px',
				esc_html__( '10px', 'hero-posts' ) 					=> '10px',
				esc_html__( '11px', 'hero-posts' ) 					=> '11px',
				esc_html__( '12px', 'hero-posts' ) 					=> '12px',
				esc_html__( '13px', 'hero-posts' ) 					=> '13px',
				esc_html__( '14px', 'hero-posts' ) 					=> '14px',
				esc_html__( '15px', 'hero-posts' ) 					=> '15px',
				esc_html__( '16px', 'hero-posts' ) 					=> '16px',
				esc_html__( '17px', 'hero-posts' ) 					=> '17px',
				esc_html__( '18px', 'hero-posts' ) 					=> '18px',
				esc_html__( '19px', 'hero-posts' ) 					=> '19px',
				esc_html__( '20px', 'hero-posts' ) 					=> '20px'
			)
		),		

		/* General custom params */
		array( 
			'param_name' 		=> 'custom_id', 
			'type' 				=> 'textfield', 
			'group' 			=> esc_html__( 'Custom', 'hero-posts' ),
			'default' 			=> '',  
			'preview' 				=> true,
			'heading' 			=> esc_html__( 'Custom Id', 'hero-posts' )
		),
		array( 
			'param_name' 		=> 'custom_class', 
			'type' 				=> 'textfield', 
			'group' 			=> esc_html__( 'Custom', 'hero-posts' ),
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Custom class', 'hero-posts' )
		),
		array( 
			'param_name' 		=> 'custom_style', 
			'type' 				=> 'textarea', 
			'group' 			=> esc_html__( 'Custom', 'hero-posts' ),
			'default' 			=> '', 
			'heading' 			=> esc_html__( 'Custom style', 'hero-posts' )
		)
	);
	Hero_Posts::$builder->map( 
		'hero_posts_item', 
		array( 
			'name' 							=> esc_html__( 'Article item', 'hero-posts' ), 
			'description' 					=> esc_html__( 'Single post template', 'hero-posts' ), 
			'container' 					=> 'vertical', 
			'icon' 							=> 'bt_bb_icon_hero_posts_item', 
			'show_settings_on_create' 		=> true, 
			'params' 						=> $params 
		)
	);
}

add_action( 'wp_loaded', 'hero_posts_item_map' );