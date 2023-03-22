<?php
/**
 * Include external scripts and styles
 */
function my_theme_load_resources()
{
    global $wp_query; 

    $theme_uri = get_stylesheet_directory_uri();
    $theme_styles = $theme_uri . '/assets/css/style.min.css';
    $theme_scripts = $theme_uri . '/assets/js/main.min.js';

    /**
     * CSS bundle connected
     */

    wp_enqueue_style( 'libs-styles', get_template_directory_uri() . '/assets/css/libs.min.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/assets/css/style.min.css' );

    /** 
     * JS bundle connected
     */
    wp_enqueue_script( 'jquery-scripts', get_template_directory_uri() . '/assets/js/jquery.min.js', array('jquery'), false );
    wp_enqueue_script( 'libs-scripts', get_template_directory_uri() . '/assets/js/libs.min.js', array('jquery'), false, true );

    wp_register_script('my_theme_functions', $theme_scripts, array('jquery'), filemtime(get_stylesheet_directory() . '/assets/js/main.min.js'), true);
    wp_enqueue_script('my_theme_functions');

    wp_localize_script('my_theme_functions', 'backend_data', [
        // Урл для обращения по ajax
        'ajax_url'          => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'my_theme_load_resources');

// отключение ненужных теме стилей и скриптов
function theme_deregister_styles_and_scripts() {
	wp_dequeue_style('wp-block-library');
}
add_action( 'wp_print_styles', 'theme_deregister_styles_and_scripts', 100 );