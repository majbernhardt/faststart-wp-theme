<?php
// Для woocommerce 
// Галерея товара
add_action( 'after_setup_theme', 'woo_gallery_init' );
function woo_gallery_init() {
  // Включить zoom на фото
  add_theme_support( 'wc-product-gallery-zoom' );
  // Включить лайтбокс
  add_theme_support( 'wc-product-gallery-lightbox' );
  // Включить слайдер
  add_theme_support( 'wc-product-gallery-slider' );
}

// Поддержка woo
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Thumb
add_theme_support( 'post-thumbnails' );

// Кастомизация шаблона woo-breadcrumbs
add_filter( 'woocommerce_breadcrumb_defaults', 'custom_woocommerce_breadcrumbs' );
function custom_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => '',
        'wrap_before' => '<section class="breadcrumbs-wrap" itemscope itemtype="http://schema.org/BreadcrumbList"><div class="container"><ul class="breadcrumbs">',
        'wrap_after'  => '</div></ul></section>',
        'before'      => '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">',
        'after'       => '<meta itemprop="position" content="%3$s" /><span>&nbsp;>&nbsp;</span></li>',
        'home'        => _x( 'Главная', 'breadcrumb', 'woocommerce' ),
    );
}

// Очистка атрибутов от ссылок
add_filter('woocommerce_attribute', 'etx_rmv_attr_lnk');
function etx_rmv_attr_lnk($att) {
    return strip_tags($att);
}

// Перенаправление архивов атрибутов на 404
// add_action('template_redirect', 'remove_woo_atts_archives');
// function remove_woo_atts_archives(){
//     if( is_tax() ) {
//         global $wp_query;
//         $taxonomies = wc_get_attribute_taxonomy_names();
//         if (in_array(get_query_var('taxonomy'), $taxonomies)) {
//             $wp_query->set_404();
//         }
//     }
// }

// Вывод заглушки если нет фото товара
function the_post_thumbnail_fallback( $size = 'post-thumbnail', $attr = '' )
{
if ( has_post_thumbnail() ) :
    echo get_the_post_thumbnail( null, $size, $attr );

else :

    $post_thumbnail_id = 7;

    $html = wp_get_attachment_image( $post_thumbnail_id, $size, false, $attr );

    /**
     * Filters the post thumbnail HTML.
     *
     * @param  string  $html  The post thumbnail HTML.
     * @param  int  $post_id  The post ID.
     * @param  string  $post_thumbnail_id  The post thumbnail ID.
     * @param  string|array  $size  The post thumbnail size. Image size or array of width and height values (in that order). Default 'post-thumbnail'.
     * @param  string  $attr  Query string of attributes.
     * @since 2.9.0
     */
    echo apply_filters( 'post_thumbnail_html', $html, null, $post_thumbnail_id, $size, $attr );

endif;
}

// Удаление уведомлений woo
// Отключение уведомления Вы отложили Товар в свою корзину
add_filter( 'wc_add_to_cart_message_html', '__return_null');
// Отключение уведомления Товар [Название] удален из Корзины. Отменить?
add_filter( 'woocommerce_cart_item_removed_notice_type', '__return_false' );

// Удаление wс-breadcrumbs из категорий
add_filter( 'woocommerce_before_main_content', 'remove_breadcrumbs');
function remove_breadcrumbs() {
    if(!is_product()) {
        remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
    }
}