<?php
add_action( 'wp_enqueue_scripts', 'tito_styles' );
function tito_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'slick-slider',   get_stylesheet_directory_uri().'/include/slick-1.8.0/slick/slick.css' );
	}
	add_action( 'wp_enqueue_scripts', 'tito_js' );
function tito_js(){
	wp_enqueue_script('slick-js', get_stylesheet_directory_uri().'/include/slick-1.8.0/slick/slick.js');
	wp_enqueue_script('JQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
}
?>
