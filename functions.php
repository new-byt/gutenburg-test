<?php


// ************************************************************************************************
// In the backend of WordPress i make a field group called "test" with a wysiwyg field called "copy".
// 
// The location must be set as "Block is equal to test"
// ************************************************************************************************


// this code handles the gutenburg editor

add_action('acf/init', 'my_acf_init');
function my_acf_init()
{

    // check function exists
    if (function_exists('acf_register_block')) {

        // register a testimonial block
        acf_register_block(array(
            'name'              => 'test',
            'title'             => __('test'),
            'mode' => "auto",
            'description'       => __('test'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'acf',
            'icon'              => 'admin-comments',
            'keywords'          => array('test'),
        ));
    }
}

function my_acf_block_render_callback($block)
{

    // convert name ("acf/test") into path friendly slug ("test")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "partials/acf-block/" folder
    if (file_exists(get_theme_file_path("partials/acf-block/{$slug}.php"))) {
        include(get_theme_file_path("partials/acf-block/{$slug}.php"));
    }
}
