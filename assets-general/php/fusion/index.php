<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add an element hero_posts_fusion to fusion-builder.
 *
 */

if ( fusion_is_element_enabled( 'hero_posts_fusion' ) ) {

	if ( ! class_exists( 'Hero_Posts_Fusion_Builder' ) && class_exists( 'Fusion_Element' ) ) {

		class Hero_Posts_Fusion_Builder extends Fusion_Element {

			/**
			 * An array of the shortcode arguments.
			 * @var array
			 */
			protected $args;

			/**
			 * Constructor.
			 */
			public function __construct() {
				parent::__construct();
				add_filter( 'fusion_attr_hero-posts-main-wrapper', [ $this, 'attr' ] );
				add_shortcode( 'hero_posts_fusion', [ $this, 'render' ] );
			}

			/**
			 * Gets the default values.
			 * @return array
			 */
			public static function get_element_defaults() {
				$fusion_settings = fusion_get_fusion_settings();
				return [
					'hero_post'  => $fusion_settings->get( 'hero_hero_post' ),
				];
			}

			/**
			 * Maps settings to param variables.
			 * @return array
			 */
			public static function settings_to_params() {
				return [
					'hero_hero_post'  => 'hero_post',
				];
			}

			/**
			 * Used to set any other variables for use on front-end editor template.
			 * @return array
			 */
			public static function get_element_extras() {
				return [];
			}

			/**
			 * Maps settings to extra variables.
			 * @return array
			 */
			public static function settings_to_extras() {
				return [];
			}

			/**
			 * Render the shortcode
			 * @param  array  $args    Shortcode parameters.
			 * @param  string $content Content between shortcode.
			 * @return string          HTML output.
			 */
			public function render( $args, $content = '' ) {

				$html		= '';
				$defaults   = FusionBuilder::set_shortcode_defaults( self::get_element_defaults(), $args, 'hero_posts_fusion' );
				$content    = apply_filters( 'fusion_shortcode_content', $content, 'hero_posts_fusion', $args );
				
				$this->args = $defaults;				

				if ( isset( $args['hero_post'] ) ) {
					$html  .= '<div ' . FusionBuilder::attributes( 'hero-posts-main-wrapper' ) . '>';
						$html  .= do_shortcode(  '[hero_posts id="' . $args["hero_post"] . '"]' );
					$html .= '</div>';
				}

				$this->on_render();

				return apply_filters( 'fusion_element_hero_posts_content', $html, $args );
			}

			/**
			 * Builds the attributes array.
			 * @return array
			 */
			public function attr() {
				$attr = [
					'class' => HERO_POSTS_ELEMENT_CLASS . ' fusion-shortcode'
				];
				return $attr;
			}

			/**
			 * Adds settings to element options panel.
			 * @return array $sections Blog settings.
			 */
			public function add_options() {
				$hero_posts			= hero_posts_get_hero_posts();

				return [
					'hero_posts_fusion_shortcode_section' => [
						'label'       => esc_attr__( 'Hello World', 'hero-posts' ),
						'description' => '',
						'id'          => 'hero_posts_fusion_shortcode_section',
						'default'     => '',
						'icon'        => 'fusiona-exclamation-triangle',
						'type'        => 'accordion',
						'fields'      => [
							'hero_hero_post' => [
								'label'       => esc_attr__( 'Hero Post', 'hero-posts' ),
								'description' => esc_attr__( 'Set the hero posts.', 'hero-posts' ),
								'id'          => 'hero_hero_post',
								'default'     => '',
								'type'        => 'select',
								'value'       => $hero_posts,
								'transport'   => 'postMessage',
							],
						],
					],
				];
			}

			/**
			 * Sets the necessary scripts.
			 * @return void
			 */
			public function add_scripts() {

				/* For example.
				Fusion_Dynamic_JS::enqueue_script(
					'fusion-date-picker',
					FUSION_BUILDER_PLUGIN_URL . 'assets-general/js/library/flatpickr.js',
					FUSION_BUILDER_PLUGIN_URL . 'assets-general/js/library/flatpickr.js',
					[ 'jquery' ],
					'1',
					true
				);
				*/
			}

			/**
			 * Load element base CSS.
			 * @return void
			 */
			public function add_css_files() {
				//FusionBuilder()->add_element_css( SAMPLE_ADDON_PLUGIN_DIR . 'css/my-elements.css' );
			}
		}
	}

	new Hero_Posts_Fusion_Builder();
}


/**
 * Map shortcode to Fusion Builder
 *
 */
function hero_posts_fusion_map() {

		$hero_posts			= function_exists( 'hero_posts_get_hero_posts' ) ? hero_posts_get_hero_posts() : array(); 
		$fusion_settings	= fusion_get_fusion_settings();

		fusion_builder_map( 
				fusion_builder_frontend_data(
					// Class reference.
					'Hero_Posts_Fusion_Builder',
					[
						'name'            => HERO_POSTS_ELEMENT_NAME,
						'shortcode'       => 'hero_posts_fusion',
						'icon'            => 'fusiona-exclamation-triangle',

						// View used on front-end.
						'front-end'		  => dirname(__FILE__) . '/hero-posts-preview.php',						
						'allow_generator'          => false,
						// Allows inline editor.
						'inline_editor'            => true,
						'inline_editor_shortcodes' => true,
						'params'   => [							
							[
								'type'        => 'select',
								'heading'     => HERO_POSTS_FIELD_TITLE,
								'description' => HERO_POSTS_FIELD_DESCRIPTION,
								'param_name'  => 'hero_post',
								'value'       => $hero_posts,
							],
						],
					]
				)
		);
}
add_action( 'fusion_builder_before_init', 'hero_posts_fusion_map' );




