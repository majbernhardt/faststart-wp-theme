<?php
// name-theme меняем на имя темы
if ( ! class_exists( 'addWidgets' ) ) :
class addWidgets {

	public function __construct() {
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
	}

	// Виджеты для подвала
	public function widgets_init() {
		$rows    = intval( apply_filters( 'footer_widget_rows', 1 ) );
		$regions = intval( apply_filters( 'footer_widget_columns', 5 ) );

		for ( $row = 1; $row <= $rows; $row++ ) {
			for ( $region = 1; $region <= $regions; $region++ ) {
				$footer_n = $region + $regions * ( $row - 1 );
				$footer   = sprintf( 'footer_%d', $footer_n );

				if ( 1 === $rows ) {
					/* translators: 1: column number */
					$footer_region_name = sprintf( __( 'Колонка в подвале %1$d', 'name-theme' ), $region );

					/* translators: 1: column number */
					$footer_region_description = sprintf( __( 'Добавленные здесь виджеты появятся в столбце %1$d подвала.', 'name-theme' ), $region );
				} else {
					/* translators: 1: row number, 2: column number */
					$footer_region_name = sprintf( __( 'Строка подвала  %1$d - Столбец %2$d', 'name-theme' ), $row, $region );

					/* translators: 1: column number, 2: row number */
					$footer_region_description = sprintf( __( 'Добавленные здесь виджеты появятся в столбце %1$d, строка %2$d.', 'name-theme' ), $region, $row );
				}

				$sidebar_args[ $footer ] = array(
					'name'        => $footer_region_name,
					'id'          => sprintf( 'footer-%d', $footer_n ),
					'description' => $footer_region_description,
				);
			}
		}

		$sidebar_args = apply_filters( 'sidebar_args', $sidebar_args );
		
		foreach ( $sidebar_args as $sidebar => $args ) {
			$widget_tags = array(
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<span class="widget-title">',
				'after_title'   => '</span>',
			);
			$filter_hook = sprintf( 'name-theme_%s_widget_tags', $sidebar );
			$widget_tags = apply_filters( $filter_hook, $widget_tags );

			if ( is_array( $widget_tags ) ) {
				register_sidebar( $args + $widget_tags );
			}
		}
	}
}
endif;

return new addWidgets();