<?php

define('THEMEPATH', get_stylesheet_directory_uri());
define('VERSION',  '1.0.0.'.$timestamp);

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', THEMEPATH . '/style.css', array( 'avada-stylesheet' ) );

    if (is_page_template( 'templates/strains.php' )) {
      wp_enqueue_style( 'strains-styles', THEMEPATH . '/styles/strains.css', array(), VERSION, 'ALL' );
    }
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );
