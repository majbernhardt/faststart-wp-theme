<?php
// Удаляем лишние пункты меню
add_action('admin_menu', 'remove_menus');
function remove_menus() {
	remove_menu_page('edit.php');                 # Записи 
	remove_menu_page('edit-comments.php');        # Комментарии
	remove_menu_page('tools.php');                # Инструменты
}

//	Регистрация меню
function theme_menus() {
	$locations = array(
		'primary'  => __( 'Главное меню', 'theme' ),
		'primary-mob'  => __( 'Мобильное меню', 'theme' )
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'theme_menus' );