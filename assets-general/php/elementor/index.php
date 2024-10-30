<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add an element hero_posts to elementor page builder.
 *
 */
if ( ! class_exists( 'Hero_Posts_Elementor' ) ) {
	class Hero_Posts_Elementor extends \Elementor\Widget_Base { 
	  
			/**
			 * Get widget name.	
			 * Retrieve Hero Posts widget name.
			 * @return string Widget name.
			 */
			public function get_name() {
				return 'hero-posts';
			}

			/**
			 * Get widget title.
			 * Retrieve Hero Posts widget title.
			 * @return string Widget title.
			 */
			public function get_title() {
				return HERO_POSTS_ELEMENT_NAME;
			}

			/**
			 * Get widget icon.
			 * Retrieve Hero Posts widget icon.
			 * @return string Widget icon.
			 */
			public function get_icon() {
				return 'eicon-code';
			}

			/**
			 * Get custom help URL.
			 * Retrieve a URL where the user can get more information about the widget.
			 * @return string Widget help URL.
			 */
			public function get_custom_help_url() {
				return 'bold-themes.com/documentation.bold-themes.com/hero-posts';
			}

			/**
			 * Get widget categories.
			 * Retrieve the list of categories the Hero Posts widget belongs to.
			 * @return array Widget categories.
			 */
			public function get_categories() {
				return [ 'bold-themes' ];
			}

			/**
			 * Get widget keywords.
			 * Retrieve the list of keywords the Hero Posts widget belongs to.
			 * @return array Widget keywords.
			 */
			public function get_keywords() {
				return [ 'hero', 'posts', 'bold', 'themes' ];
			}

			/**
			 * Register Hero Posts widget controls.
			 *
			 */
			protected function register_controls() {
					$this->start_controls_section(
						'content_section',
						[
							'label' => esc_html__( 'Content', 'hero-posts' ),
							'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
						]
					);
					$this->add_control(
						'hero_post',
						array(
							'label' => HERO_POSTS_FIELD_TITLE,
							'type' => \Elementor\Controls_Manager::SELECT,
							'default' => '',
							'options' => hero_posts_get_hero_posts(),
							'style_transfer' => true,
						)
					);
					$this->end_controls_section();
			}

			/**
			 * Render Hero Posts widget output on the frontend.
			 *
			 */
			protected function render() {
				$settings = $this->get_settings_for_display();	
				$hero_post	= $settings['hero_post'];

				if ( intval($hero_post) > 0 ) {
				?>
					<div class="<?php echo esc_attr( HERO_POSTS_ELEMENT_CLASS );?> elementor-shortcode">
						<?php echo do_shortcode( '[hero_posts id="' . $hero_post . '"]' );?>
					</div>
				<?php
				// wp_enqueue_script( 'script-handle', 'path/to/file.js', [ 'elementor-frontend' ], '1.0.0', true );
				
				wp_enqueue_script( 
					'swiper',
					plugin_dir_url( __FILE__ ) . '../js/swiper-bundle.min.js',
					array( 'jquery', 'elementor-frontend' )
				);
				wp_enqueue_script( 
					'hero-posts-swiper-helper',
					plugin_dir_url( __FILE__ ) . '../js/hero-posts-swiper-helper.js',
					array( 'jquery', 'swiper', 'elementor-frontend' )
				);
				wp_enqueue_style( 
					'hero-posts-swiper', 
					plugin_dir_url( __FILE__ ) . '../css/swiper-bundle.min.css'
				);
				}
			}

			protected function content_template() {
				
			}
	}
}