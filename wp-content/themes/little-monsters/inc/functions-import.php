<?php

function littlemonsters_fnc_import_remote_demos() {
    return array(
        'littlemonsters' => array(
            'name' => 'littlemonsters',
            'source' => esc_url('http://wpsampledemo.com/little-monsters/little-monsters.zip'),
            'preview' => esc_url('http://wpsampledemo.com/little-monsters/screenshot.png')
        ),
    );
}

add_filter( 'wpopal_themer_import_remote_demos', 'littlemonsters_fnc_import_remote_demos' );


function littlemonsters_fnc_import_theme() {
    return 'littlemonsters';
}

add_filter( 'wpopal_themer_import_theme', 'littlemonsters_fnc_import_theme' );

function littlemonsters_fnc_import_demos() {
    $folderes = glob( get_template_directory() . '/inc/import/*', GLOB_ONLYDIR );

    $output = array();

    foreach ($folderes as $folder) {
        $output[basename( $folder )] = basename( $folder );
    }

    return $output;
}

add_filter( 'wpopal_themer_import_demos', 'littlemonsters_fnc_import_demos' );

function littlemonsters_fnc_import_types() {
    return array(
        'all' => esc_html__( 'All', 'little-monsters' ),
        'content' => esc_html__( 'Content', 'little-monsters' ),
        'widgets' => esc_html__( 'Widgets', 'little-monsters' ),
        'page_options' => esc_html__( 'Theme + Page Options', 'little-monsters' ),
        'menus' => esc_html__( 'Menus', 'little-monsters' ),
        'rev_slider' => esc_html__( 'Revolution Slider', 'little-monsters' ),
        'vc_templates' => esc_html__( 'VC Templates', 'little-monsters' )
    );
}

add_filter( 'wpopal_themer_import_types', 'littlemonsters_fnc_import_types' );
/**
 * Matching and resizing images with url.
 *
 *  $ouput = array(
 *        'allowed' => 1, // allow resize images via using GD Lib php to generate image
 *        'height'  => 900,
 *        'width'   => 800,
 *        'file_name' => 'blog_demo.jpg'
 *   );
 */
function littlemonsters_import_attachment_image_size($url) {

    $name = basename( $url );

    $ouput = array(
        'allowed' => 0
    );

    if (preg_match( "#gallery#", $name )) {
        $ouput = array(
            'allowed' => 1,
            'height' => 632,
            'width' => 900,
            'file_name' => 'product_demo.jpg'
        );
    } elseif (preg_match( "#blog#", $name )) {
        $ouput = array(
            'allowed' => 1,
            'height' => 724,
            'width' => 1170,
            'file_name' => 'blog_demo.jpg'
        );
    } elseif (preg_match( "#room#", $name )) {
        $ouput = array(
            'allowed' => 1,
            'height' => 655,
            'width' => 900,
            'file_name' => 'blog_demo.jpg'
        );
    }

    return $ouput;
}

add_filter( 'pbrthemer_import_attachment_image_size', 'littlemonsters_import_attachment_image_size', 1, 999 );