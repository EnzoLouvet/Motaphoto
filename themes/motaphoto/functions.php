<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/assets/css/header.css' );
    wp_enqueue_style( 'footer-style', get_template_directory_uri() . '/assets/css/footer.css' );
    wp_enqueue_style( 'modale-style', get_template_directory_uri() . '/assets/css/modal.css' );
    wp_enqueue_script( 'modale-js', get_template_directory_uri() . '/assets/js/modal.js' );

}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

//////////////////////////////////////////////////////////////


function register_my_menu() {
    register_nav_menus(
        array(
            'header' => __('Header'),
            'footer' => __('Footer'),
        )
    );
}
add_action( 'init', 'register_my_menu' );

//////////////////////////////////////////////////////////////


