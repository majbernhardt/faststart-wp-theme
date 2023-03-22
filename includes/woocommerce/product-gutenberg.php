<?php
add_filter( 'use_block_editor_for_post_type', 'art_enable_rest_for_product', 10, 2 );
add_filter( 'woocommerce_taxonomy_args_product_cat', 'art_show_in_rest_for_product', 10, 1 );
add_filter( 'woocommerce_taxonomy_args_product_tag', 'art_show_in_rest_for_product', 10, 1 );
add_filter( 'woocommerce_register_post_type_product', 'art_show_in_rest_for_product', 10, 1 );

/**
 * Включение редактора Gutenberg для товаров
 *
 * @sourcecode https://wpruse.ru/?p=4150
 *
 * @param  bool   $can_edit
 * @param  string $post_type
 *
 * @return bool
 *
 * @author        Artem Abramovich
 * @testedwith    WC 3.9
 */
function art_enable_rest_for_product( $can_edit, $post_type ) {

	if ( 'product' === $post_type ) {
		$can_edit = true;
	}

	return $can_edit;
}

/**
 * Включение поддержки REST для товаров
 *
 * @sourcecode https://wpruse.ru/?p=4150
 *
 * @param  array $args
 *
 * @return mixed
 *
 * @author        Artem Abramovich
 * @testedwith    WC 3.9
 */
function art_show_in_rest_for_product( $args ) {

	$args['show_in_rest'] = true;

	return $args;
}