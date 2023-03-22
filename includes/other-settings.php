<?php
// Отображение заголовка плагинов
add_theme_support( 'title-tag' );

// Кастомный лого
add_theme_support(
	'custom-logo',
	apply_filters(
		'custom_logo_args',
		array(
			'height'      => 80,
			'width'       => 167,
			'flex-width'  => true,
			'flex-height' => true,
		)
	)
);

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

/**
 * Склонение существительных после числительных.
 * 
 * @param string $value Значение
 * @param array $words Массив вариантов, например: array('товар', 'товара', 'товаров')
 * @param bool $show Включает значение $value в результирующею строку
 * @return string
*/
function num_word($value, $words, $show = true) 
{
	$num = $value % 100;
	if ($num > 19) { 
		$num = $num % 10; 
	}
	$out = ($show) ?  $value . ' ' : '';
	switch ($num) {
		case 1:  $out .= $words[0]; break;
		case 2: 
		case 3: 
		case 4:  $out .= $words[1]; break;
		default: $out .= $words[2]; break;
	}
	return $out;
}

// Конвертация размеров файлов use "echo formatBytes(value);"
function formatBytes($size, $precision = 2){
    $base = log($size, 1024);
    $suffixes = array('Б', 'КБ', 'МБ', 'ГБ', 'ТБ');
    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}