<?php
// example меняем на нужное название блока, оно должно быть уникальным
// каждый блок должен быть отдельным файлом
// файлы с блоками подключаются в functions.php

add_action('acf/init', 'my_acf_block_example');
function my_acf_block_example()
{
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'block_example',
            'title'             => ('Пример блока'),
            'description'       => ('Пример блока'),
            'render_callback'   => 'render_block_example',
            'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                'mode' => false,
                'jsx' => true
            ),
            'example'          => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'is_preview'    => true
                    )
                )
            )
        ));
    }
}

function render_block_example($block, $content = '', $is_preview = false, $post_id = 0)
{
    $id = 'block_block-example' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }

?>

<!-- Здесь вёрстка с acf полями -->

<?php }