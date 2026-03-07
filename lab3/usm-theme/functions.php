<?php

function usm_scripts() {
    wp_enqueue_style( 'usm-theme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'usm_scripts' );