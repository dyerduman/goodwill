<?php
/* enqueue scripts and style from parent theme */

function twentytwentyone_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_uri(),
	array( 'twenty-twenty-one-style' ), wp_get_theme()->get('Version') );
}
add_action( 'wp_enqueue_scripts', 'twentytwentyone_styles');

register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'twentytwentyone-child'),
    'secondary' => __( 'Languages', 'twentytwentyone-child' ),
 ) );
