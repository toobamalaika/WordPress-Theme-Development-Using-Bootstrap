<?php

function my_theme_style() {

	wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style('animate_css', get_template_directory_uri() . '/css/animate.css');
	wp_enqueue_style('font_awesome_css', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style('owl_carousel_css', get_template_directory_uri() . '/css/owl.carousel.css');
	wp_enqueue_style('owl_theme_css', get_template_directory_uri() . '/css/owl.theme.default.min.css');
	wp_enqueue_style('swiper_css', get_template_directory_uri() . '/css/swiper.min.css');
	wp_enqueue_style('hover_css', get_template_directory_uri() . '/css/hover.min.css');
	wp_enqueue_style('inston_icons_css', get_template_directory_uri() . '/plugins/inston-icons/style.css');
	wp_enqueue_style('main_style', get_template_directory_uri() . '/css/style.css');
	wp_enqueue_style('responsive_css', get_template_directory_uri() . '/css/responsive.css');

}

// call hook for load css files
add_action('wp_enqueue_scripts', 'my_theme_style');

function my_theme_js() {

	wp_enqueue_script('jquery_js', get_template_directory_uri() . '/js/jquery.js', array('jquery'), '', true);
	wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '', true);
	wp_enqueue_script('swipper_js', get_template_directory_uri() . '/js/swiper.min.js', array('jquery'), '', true);
	wp_enqueue_script('owl_carouser_js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '', true);
	wp_enqueue_script('theme_js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '', true);

}

// call hook for load javascript and jquery
add_action('wp_enqueue_scripts', 'my_theme_js');

?>