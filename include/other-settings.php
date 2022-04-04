<?php
// Подключение скриптов и стилей
function my_enqueue() {
    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery') );
    wp_localize_script( 'ajax-script', 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'my_enqueue' );

// Страница настроек
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
}

// Удаляем лишние пункты меню
add_action('admin_menu', 'remove_menus');
function remove_menus() {
	remove_menu_page('edit.php');                 # Записи 
	remove_menu_page('edit-comments.php');        # Комментарии
	remove_menu_page('tools.php');                # Инструменты
}

// отключение ненужных теме стили и скрипты
function theme_deregister_styles_and_scripts() {
	wp_dequeue_style('wp-block-library');
}
add_action( 'wp_print_styles', 'theme_deregister_styles_and_scripts', 100 );

// Удаляем лишние <p> и <br/> в выводе Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');
add_filter('wpcf7_form_elements', function($content) {
	$content = str_replace('<br />', '', $content);
	return $content;
});
// Удаляем подключаемые Contact Form 7 стили
add_filter( 'wpcf7_load_css', '__return_false' );

//	Регистрация меню
function theme_menus() {
	$locations = array(
		'primary'  => __( 'Главное меню', 'theme' ),
		'primary-footer'  => __( 'Меню в футере', 'theme' ),
		'primary-mob'  => __( 'Мобильное меню', 'theme' )
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'theme_menus' );

//	Добавление столбца ID записи/страницы
function true_id($args){
	$args['post_page_id'] = 'ID';
	return $args;
}
function true_custom($column, $id){
	if($column === 'post_page_id'){
		echo $id;
	}
}
add_filter('manage_pages_columns', 'true_id', 5);
add_action('manage_pages_custom_column', 'true_custom', 5, 2);
add_filter('manage_posts_columns', 'true_id', 5);
add_action('manage_posts_custom_column', 'true_custom', 5, 2);

// Отключение стандартного jquery
function remove_jq_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
			$script->deps = array_diff( $script->deps, array( 'jquery-core' ) );
		}
	}
}
add_action( 'wp_default_scripts', 'remove_jq_migrate' );