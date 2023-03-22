<?php
/*
* ThemeName
*/

/**
 * Utils folder for custom hooks
 */
include 'includes/utils/index.php';
include 'includes/utils/menu.php';
include 'includes/utils/widgets.php';

/** 
 * Utils folder for ACF settings
 */
include 'includes/acf/index.php';

/**
 * Ajax callback via admin-ajax
 */
// include 'includes/callback/example.php';

/**
 * Specify rewrites for woocommerce
 */
include 'includes/woocommerce/unhooks.php';
include 'includes/woocommerce/product-gutenberg.php';
include 'includes/woocommerce/woo-custom.php';

// Support svg
include 'includes/add-svg.php';

// Other
include 'includes/other-settings.php';

// Gutenberg blocks
include_once 'template-parts/blocks/block-example.php';
// include_once 'template-parts/blocks/block-example2.php';
// include_once 'template-parts/blocks/block-example3.php';

// Add backend styles for Gutenberg.
add_action('enqueue_block_editor_assets', 'gutenberg_editor_assets');
function gutenberg_editor_assets() {
    // Load the theme styles within Gutenberg.
    wp_enqueue_style('custom-gutenberg-editor-styles', get_theme_file_uri('assets/css/style.min.css'), FALSE);
    wp_enqueue_style('custom-gutenberg-editor-libs', get_theme_file_uri('assets/css/libs.min.css'), FALSE);
    wp_enqueue_style('custom-gutenberg-editor-admin', get_theme_file_uri('assets/css/admin.css'), FALSE);
    wp_enqueue_style( google_fonts() );
}

// Шрифт для гутенберга в админке
function google_fonts() {
	$google_fonts = apply_filters(
		'storefront_google_font_families',
		array(
			'IBM-Plex-Sans' => 'IBM+Plex+Sans:300,400,500,600,700',
		)
	);
	$query_args = array(
		'family' => implode( '|', $google_fonts ),
		'subset' => rawurlencode( 'cyrillic,cyrillic-ext' ),
	);
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	return $fonts_url;
}

// remove jquery migrate
function wpschool_remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}
add_action('wp_default_scripts', 'wpschool_remove_jquery_migrate');