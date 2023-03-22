<?php

// отключаем стандартные стили woocommerce
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

function child_manage_woocommerce_styles() {
    //убираем generator meta tag
    remove_action('wp_head', array($GLOBALS['woocommerce'], 'generator'));
    
    //для начала проверяем, активен ли WooCommerce, дабы избежать ошибок
    if (function_exists('is_woocommerce')) {
        //отменяем загрузку скриптов и стилей
        wp_deregister_style('woocommerce_frontend_styles');
        wp_deregister_style('woocommerce_fancybox_styles');
        wp_deregister_style('woocommerce_chosen_styles');
        wp_deregister_style('woocommerce_prettyPhoto_css');
        wp_deregister_style('wc-block-style');
        wp_deregister_style('woocommerce-inline-inline-css');
        wp_deregister_style('wc-blocks-vendors-style-css');

        wp_deregister_script('wc_price_slider');
        wp_deregister_script('wc-single-product');
        wp_deregister_script( 'wc-add-to-cart' );
        wp_deregister_script( 'wc-cart-fragments' );
        wp_deregister_script( 'wc-checkout' );

        // Change wp_deregister_script to "deregister", because script anyway has been loaded  
        wp_deregister_script('wc-add-to-cart-variation');
        wp_deregister_script( 'wc-cart' );
        
        wp_deregister_script('wc-single-product');
        wp_deregister_script('wc-chosen');
        wp_deregister_script('woocommerce');
        wp_deregister_script('prettyPhoto');
        wp_deregister_script('prettyPhoto-init');
        wp_deregister_script('jquery-placeholder');
        wp_deregister_script('fancybox');
        wp_deregister_script('jquery-blockui-js');
        wp_deregister_script('jqueryui');

        wp_deregister_script('zoom');
        wp_dequeue_script('zoom');
        wp_deregister_script('flexslider');
        wp_deregister_script('photoswipe');
        wp_deregister_script('photoswipe-ui-default');
    }
}

// Force displaying variation attributes in the product name (in cart/minicart/checkout)
add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_true' );
// (Optional) Force displaying product variation attributes as separated formatted metadata (in cart/minicart/checkout)
add_filter( 'woocommerce_is_attribute_in_product_name', '__return_false' );