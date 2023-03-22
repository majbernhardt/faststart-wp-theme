<?php
/**
 * Adding option page
 */
if( function_exists('acf_add_options_page') ) {	
	acf_add_options_page(array(
		'page_title' 	=> 'Основные настройки',
		'menu_title'	=> 'Настройки темы',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'update_button'	=> __('Обновить', 'acf'),
		'position' 		=> 3,
		'redirect'		=> false
	));
    acf_add_options_sub_page(array(
        'page_title'    => 'Настройки шапки',
        'menu_title'    => 'Шапка',
        'capability'    => 'edit_posts',
        'menu_slug'     => 'theme-header-settings',
        'parent_slug'   => 'theme-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'    => 'Настройки подвала',
        'menu_title'    => 'Подвал',
        'capability'    => 'edit_posts',
        'menu_slug'     => 'theme-header-settings',
        'parent_slug'   => 'theme-general-settings',
    ));
}