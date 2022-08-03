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
add_action('template_redirect', 'remove_woo_atts_archives');
function remove_woo_atts_archives(){
    if( is_tax() ) {
        global $wp_query;
        $taxonomies = wc_get_attribute_taxonomy_names();
        if (in_array(get_query_var('taxonomy'), $taxonomies)) {
            $wp_query->set_404();
        }
    }
}


// Прочее
// Транслитерация слов
function translit($value) {
	$converter = array(
		'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
		'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
		'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
		'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
		'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
		'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
		'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

		'А' => 'a',    'Б' => 'b',    'В' => 'v',    'g' => 'g',    'Д' => 'd',
		'Е' => 'e',    'Ё' => 'e',    'Ж' => 'zh',   'З' => 'z',    'И' => 'i',
		'Й' => 'y',    'К' => 'k',    'Л' => 'l',    'М' => 'm',    'Н' => 'n',
		'О' => 'o',    'П' => 'p',    'Р' => 'r',    'С' => 's',    'Т' => 't',
		'У' => 'u',    'Ф' => 'f',    'Х' => 'h',    'Ц' => 'c',    'Ч' => 'ch',
		'Ш' => 'sh',   'Щ' => 'sch',  'Ь' => '',     'Ы' => 'y',    'Ъ' => '',
		'Э' => 'e',    'Ю' => 'yu',   'Я' => 'ya', 
	);
	$value = mb_strtolower($value);
	$value = strtr($value, $converter);
	$value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
	$value = mb_ereg_replace('[-]+', '-', $value);
	$value = trim($value, '-');
	return $value;
}