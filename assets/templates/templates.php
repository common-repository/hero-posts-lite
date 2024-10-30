<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

Hero_Posts::$templates = [
	'blank' => 				[ 'name' => esc_html__( 'Blank template', 'hero-posts' ), 'pro_only' => false  ],
	'classic-A-01' => 		[ 'name' => esc_html__( 'Classic A 01', 'hero-posts' ), 'pro_only' => false  ],
	'classic-A-02' => 		[ 'name' => esc_html__( 'Classic A 02', 'hero-posts' ), 'pro_only' => false  ],
	'classic-A-03' => 		[ 'name' => esc_html__( 'Classic A 03', 'hero-posts' ), 'pro_only' => false  ],
	'classic-A-04' => 		[ 'name' => esc_html__( 'Classic A 04', 'hero-posts' ), 'pro_only' => true  ],
	'classic-A-05' => 		[ 'name' => esc_html__( 'Classic A 05', 'hero-posts' ), 'pro_only' => true  ],
	'classic-A-06' => 		[ 'name' => esc_html__( 'Classic A 06', 'hero-posts' ), 'pro_only' => true  ],
	'classic-A-07' => 		[ 'name' => esc_html__( 'Classic A 07', 'hero-posts' ), 'pro_only' => true  ],
	'classic-A-08' => 		[ 'name' => esc_html__( 'Classic A 08', 'hero-posts' ), 'pro_only' => false  ],
	'classic-B-01' => 		[ 'name' => esc_html__( 'Classic B 01', 'hero-posts' ), 'pro_only' => false  ],
	'classic-B-02' => 		[ 'name' => esc_html__( 'Classic B 02', 'hero-posts' ), 'pro_only' => false  ],
	'classic-B-03' => 		[ 'name' => esc_html__( 'Classic B 03', 'hero-posts' ), 'pro_only' => false  ],
	'classic-B-04' => 		[ 'name' => esc_html__( 'Classic B 04', 'hero-posts' ), 'pro_only' => false  ],
	'classic-B-05' => 		[ 'name' => esc_html__( 'Classic B 05', 'hero-posts' ), 'pro_only' => true  ],
	'classic-B-06' => 		[ 'name' => esc_html__( 'Classic B 06', 'hero-posts' ), 'pro_only' => true  ],
	'classic-B-07' => 		[ 'name' => esc_html__( 'Classic B 07', 'hero-posts' ), 'pro_only' => true  ],
	'classic-B-08' => 		[ 'name' => esc_html__( 'Classic B 08', 'hero-posts' ), 'pro_only' => true  ],
	'classic-B-09' => 		[ 'name' => esc_html__( 'Classic B 09', 'hero-posts' ), 'pro_only' => true  ],
	'classic-B-10' => 		[ 'name' => esc_html__( 'Classic B 10', 'hero-posts' ), 'pro_only' => true  ],
	'classic-B-11' => 		[ 'name' => esc_html__( 'Classic B 11', 'hero-posts' ), 'pro_only' => true  ],
	'classic-B-12' => 		[ 'name' => esc_html__( 'Classic B 12', 'hero-posts' ), 'pro_only' => true  ],
	'classic-C-01' => 		[ 'name' => esc_html__( 'Classic C 01', 'hero-posts' ), 'pro_only' => false  ],
	'classic-C-02' => 		[ 'name' => esc_html__( 'Classic C 02', 'hero-posts' ), 'pro_only' => true  ],
	'classic-C-03' => 		[ 'name' => esc_html__( 'Classic C 03', 'hero-posts' ), 'pro_only' => true  ],
	'classic-D-01' => 		[ 'name' => esc_html__( 'Classic D 01', 'hero-posts' ), 'pro_only' => false  ],
	'classic-D-02' => 		[ 'name' => esc_html__( 'Classic D 02', 'hero-posts' ), 'pro_only' => false  ],
	'classic-D-03' => 		[ 'name' => esc_html__( 'Classic D 03', 'hero-posts' ), 'pro_only' => true  ],
	'classic-D-04' => 		[ 'name' => esc_html__( 'Classic D 04', 'hero-posts' ), 'pro_only' => true  ],
	'classic-D-05' => 		[ 'name' => esc_html__( 'Classic D 05', 'hero-posts' ), 'pro_only' => true  ],
	'classic-D-06' => 		[ 'name' => esc_html__( 'Classic D 06', 'hero-posts' ), 'pro_only' => true  ],
	'classic-E-01' => 		[ 'name' => esc_html__( 'Classic E 01', 'hero-posts' ), 'pro_only' => false  ],
	'classic-E-02' => 		[ 'name' => esc_html__( 'Classic E 02', 'hero-posts' ), 'pro_only' => false  ],
	'classic-E-03' => 		[ 'name' => esc_html__( 'Classic E 03', 'hero-posts' ), 'pro_only' => false  ],
	'classic-E-04' => 		[ 'name' => esc_html__( 'Classic E 04', 'hero-posts' ), 'pro_only' => true  ],
	'classic-E-05' => 		[ 'name' => esc_html__( 'Classic E 05', 'hero-posts' ), 'pro_only' => true  ],
	'classic-E-06' => 		[ 'name' => esc_html__( 'Classic E 06', 'hero-posts' ), 'pro_only' => true  ],
	'classic-E-07' => 		[ 'name' => esc_html__( 'Classic E 07', 'hero-posts' ), 'pro_only' => true  ],
	'classic-E-08' => 		[ 'name' => esc_html__( 'Classic E 08', 'hero-posts' ), 'pro_only' => true  ],
	'classic-F-01' => 		[ 'name' => esc_html__( 'Classic F 01', 'hero-posts' ), 'pro_only' => false  ],
	'classic-F-02' => 		[ 'name' => esc_html__( 'Classic F 02', 'hero-posts' ), 'pro_only' => false  ],
	'classic-F-03' => 		[ 'name' => esc_html__( 'Classic F 03', 'hero-posts' ), 'pro_only' => false  ],
	'classic-F-04' => 		[ 'name' => esc_html__( 'Classic F 04', 'hero-posts' ), 'pro_only' => true  ],
	'classic-F-05' => 		[ 'name' => esc_html__( 'Classic F 05', 'hero-posts' ), 'pro_only' => true  ],
	'classic-F-06' => 		[ 'name' => esc_html__( 'Classic F 06', 'hero-posts' ), 'pro_only' => true  ],
	'classic-F-07' => 		[ 'name' => esc_html__( 'Classic F 07', 'hero-posts' ), 'pro_only' => true  ],
	'classic-F-08' => 		[ 'name' => esc_html__( 'Classic F 08', 'hero-posts' ), 'pro_only' => true  ],
	'classic-F-09' => 		[ 'name' => esc_html__( 'Classic F 09', 'hero-posts' ), 'pro_only' => true  ],
	'modern-A-01' => 		[ 'name' => esc_html__( 'Modern A 01', 'hero-posts' ), 'pro_only' => false  ],
	'modern-A-02' => 		[ 'name' => esc_html__( 'Modern A 02', 'hero-posts' ), 'pro_only' => false  ],
	'modern-A-03' => 		[ 'name' => esc_html__( 'Modern A 03', 'hero-posts' ), 'pro_only' => true  ],
	'modern-A-04' => 		[ 'name' => esc_html__( 'Modern A 04', 'hero-posts' ), 'pro_only' => true  ],
	'modern-A-05' => 		[ 'name' => esc_html__( 'Modern A 05', 'hero-posts' ), 'pro_only' => true  ],
	'modern-A-06' => 		[ 'name' => esc_html__( 'Modern A 06', 'hero-posts' ), 'pro_only' => true  ],
	'modern-B-01' => 		[ 'name' => esc_html__( 'Modern B 01', 'hero-posts' ), 'pro_only' => false  ],
	'modern-B-02' => 		[ 'name' => esc_html__( 'Modern B 02', 'hero-posts' ), 'pro_only' => false  ],
	'modern-B-03' => 		[ 'name' => esc_html__( 'Modern B 03', 'hero-posts' ), 'pro_only' => false  ],
	'modern-B-04' => 		[ 'name' => esc_html__( 'Modern B 04', 'hero-posts' ), 'pro_only' => false  ],
	'modern-B-05' => 		[ 'name' => esc_html__( 'Modern B 05', 'hero-posts' ), 'pro_only' => true  ],
	'modern-B-06' => 		[ 'name' => esc_html__( 'Modern B 06', 'hero-posts' ), 'pro_only' => true  ],
	'modern-B-07' => 		[ 'name' => esc_html__( 'Modern B 07', 'hero-posts' ), 'pro_only' => true  ],
	'modern-B-08' => 		[ 'name' => esc_html__( 'Modern B 08', 'hero-posts' ), 'pro_only' => true  ],
	'modern-B-09' => 		[ 'name' => esc_html__( 'Modern B 09', 'hero-posts' ), 'pro_only' => true  ],
	'modern-B-10' => 		[ 'name' => esc_html__( 'Modern B 10', 'hero-posts' ), 'pro_only' => true  ],
	'modern-C-01' => 		[ 'name' => esc_html__( 'Modern C 01', 'hero-posts' ), 'pro_only' => false  ],
	'modern-C-02' => 		[ 'name' => esc_html__( 'Modern C 02', 'hero-posts' ), 'pro_only' => false  ],
	'modern-C-03' => 		[ 'name' => esc_html__( 'Modern C 03', 'hero-posts' ), 'pro_only' => true  ],
	'modern-C-04' => 		[ 'name' => esc_html__( 'Modern C 04', 'hero-posts' ), 'pro_only' => true  ],
	'modern-C-05' => 		[ 'name' => esc_html__( 'Modern C 05', 'hero-posts' ), 'pro_only' => true  ],
	'modern-D-01' => 		[ 'name' => esc_html__( 'Modern D 01', 'hero-posts' ), 'pro_only' => false  ],
	'modern-D-02' => 		[ 'name' => esc_html__( 'Modern D 02', 'hero-posts' ), 'pro_only' => false  ],
	'modern-D-03' => 		[ 'name' => esc_html__( 'Modern D 03', 'hero-posts' ), 'pro_only' => true  ],
	'modern-D-04' => 		[ 'name' => esc_html__( 'Modern D 04', 'hero-posts' ), 'pro_only' => true  ],
	'modern-D-05' => 		[ 'name' => esc_html__( 'Modern D 05', 'hero-posts' ), 'pro_only' => true  ],
	'modern-E-01' => 		[ 'name' => esc_html__( 'Modern E 01', 'hero-posts' ), 'pro_only' => false  ],
	'modern-E-02' => 		[ 'name' => esc_html__( 'Modern E 02', 'hero-posts' ), 'pro_only' => false  ],
	'modern-E-03' => 		[ 'name' => esc_html__( 'Modern E 03', 'hero-posts' ), 'pro_only' => false  ],
	'modern-E-04' => 		[ 'name' => esc_html__( 'Modern E 04', 'hero-posts' ), 'pro_only' => true  ],
	'modern-E-05' => 		[ 'name' => esc_html__( 'Modern E 05', 'hero-posts' ), 'pro_only' => true  ],
	'modern-E-06' => 		[ 'name' => esc_html__( 'Modern E 06', 'hero-posts' ), 'pro_only' => true  ],
	'modern-E-07' => 		[ 'name' => esc_html__( 'Modern E 07', 'hero-posts' ), 'pro_only' => true  ],
	'modern-F-01' => 		[ 'name' => esc_html__( 'Modern F 01', 'hero-posts' ), 'pro_only' => false  ],
	'modern-F-02' => 		[ 'name' => esc_html__( 'Modern F 02', 'hero-posts' ), 'pro_only' => false  ],
	'modern-F-03' => 		[ 'name' => esc_html__( 'Modern F 03', 'hero-posts' ), 'pro_only' => false  ],
	'modern-F-04' => 		[ 'name' => esc_html__( 'Modern F 04', 'hero-posts' ), 'pro_only' => true  ],
	'modern-F-05' => 		[ 'name' => esc_html__( 'Modern F 05', 'hero-posts' ), 'pro_only' => true  ],
	'modern-F-06' => 		[ 'name' => esc_html__( 'Modern F 06', 'hero-posts' ), 'pro_only' => true  ],
	'modern-F-07' => 		[ 'name' => esc_html__( 'Modern F 07', 'hero-posts' ), 'pro_only' => true  ],
	'slider-A-01' => 		[ 'name' => esc_html__( 'Slider A 01', 'hero-posts' ), 'pro_only' => false  ],
	'slider-A-02' => 		[ 'name' => esc_html__( 'Slider A 02', 'hero-posts' ), 'pro_only' => true  ],
	'slider-A-03' => 		[ 'name' => esc_html__( 'Slider A 03', 'hero-posts' ), 'pro_only' => true  ],
	'slider-B-01' => 		[ 'name' => esc_html__( 'Slider B 01', 'hero-posts' ), 'pro_only' => false  ],
	'slider-B-02' => 		[ 'name' => esc_html__( 'Slider B 02', 'hero-posts' ), 'pro_only' => true  ],
	'slider-B-03' => 		[ 'name' => esc_html__( 'Slider B 03', 'hero-posts' ), 'pro_only' => true  ],
	'slider-C-01' => 		[ 'name' => esc_html__( 'Slider C 01', 'hero-posts' ), 'pro_only' => false  ],
	'slider-C-02' => 		[ 'name' => esc_html__( 'Slider C 02', 'hero-posts' ), 'pro_only' => false  ],
	'slider-C-03' => 		[ 'name' => esc_html__( 'Slider C 03', 'hero-posts' ), 'pro_only' => true  ],
	'slider-C-04' => 		[ 'name' => esc_html__( 'Slider C 04', 'hero-posts' ), 'pro_only' => true  ],
	'slider-D-01' => 		[ 'name' => esc_html__( 'Slider D 01', 'hero-posts' ), 'pro_only' => false  ],
	'slider-D-02' => 		[ 'name' => esc_html__( 'Slider D 02', 'hero-posts' ), 'pro_only' => false  ],
	'slider-D-03' => 		[ 'name' => esc_html__( 'Slider D 03', 'hero-posts' ), 'pro_only' => true  ],
	'slider-D-04' => 		[ 'name' => esc_html__( 'Slider D 04', 'hero-posts' ), 'pro_only' => true  ],
	'slider-D-05' => 		[ 'name' => esc_html__( 'Slider D 05', 'hero-posts' ), 'pro_only' => true  ],
	'slider-D-06' => 		[ 'name' => esc_html__( 'Slider D 06', 'hero-posts' ), 'pro_only' => true  ],
	'slider-E-01' => 		[ 'name' => esc_html__( 'Slider E 01', 'hero-posts' ), 'pro_only' => false  ],
	'slider-E-02' => 		[ 'name' => esc_html__( 'Slider E 02', 'hero-posts' ), 'pro_only' => true  ],
	'slider-E-03' => 		[ 'name' => esc_html__( 'Slider E 03', 'hero-posts' ), 'pro_only' => true  ],
];


function hero_posts_get_template() {
	$item = sanitize_text_field( $_POST['item'] );
	$item_content = @file_get_contents( plugin_dir_url( __FILE__ ) . 'data/' . $item . '.txt' );
	echo esc_html( $item_content );
	die();
}
add_action( 'wp_ajax_hero_posts_get_template', 'hero_posts_get_template' );