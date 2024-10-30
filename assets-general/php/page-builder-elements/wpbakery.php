<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
/**
 * WPBakery Hero Posts Page Builder Element
 */

if ( ! class_exists( 'Hero_Posts_WPB' ) ) {

    class Hero_Posts_WPB {

        public function __construct() {			
				add_shortcode( 'hero_posts_wpb', __CLASS__ . '::output' );	
				add_action( 'vc_before_init',  __CLASS__ . '::map' );
		}        

		public static function map() {			
				if ( function_exists( 'vc_map' ) ) {
						$hero_posts = function_exists( 'hero_posts_get_hero_posts_wpbakery_bb' ) ? hero_posts_get_hero_posts_wpbakery_bb() : array(); 
						vc_map( array( 				 
								'name'        => HERO_POSTS_ELEMENT_NAME,
								'description' => HERO_POSTS_ELEMENT_DESCRIPTION,
								'category'	  => HERO_POSTS_WPBAKERY_CATEGORY,//esc_html__( 'by BoldThemes', 'hero-posts' ),
								'base'        => 'hero_posts_wpb',
								'params'      => array(									
									array(
										'type'			=> 'dropdown',
										'class'			=> "",
										'heading'		=> HERO_POSTS_FIELD_TITLE,
										'param_name'	=> 'hero_post',
										'value'			=> $hero_posts,
										'description'	=> HERO_POSTS_FIELD_DESCRIPTION 
									),						
								),
						 
						 ) );
				}
        }

        public static function output( $atts, $content = null ) {          
            $atts = vc_map_get_attributes( 'hero_posts_wpb', $atts );           
		    if ( isset( $atts['hero_post'] ) ) {
				?>
				<div class="<?php echo HERO_POSTS_ELEMENT_CLASS;?> wpb-shortcode">
					<p><?php echo do_shortcode( '[hero_posts id="' . esc_attr( $atts["hero_post"] ) . '"]' );?></p>
				</div>
				<?php
			}
        }
    }

    new Hero_Posts_WPB();
}



