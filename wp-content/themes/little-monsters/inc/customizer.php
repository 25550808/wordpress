<?php
/**
 * mode Customizer support
 *
 * @package WpOpal
 * @subpackage littlemonsters
 * @since littlemonsters 1.0
 */
//Update logo wordpress 4.5
if (version_compare($GLOBALS['wp_version'], '4.5', '>=')) {
    function littlemonsters_fnc_setup_logo()
    {
        add_theme_support('custom-logo');
    }

    add_action('after_setup_theme', 'littlemonsters_fnc_setup_logo');
}
if ( ! function_exists( 'littlemonsters_fnc_customize_register' ) ) :
function littlemonsters_fnc_customize_register($wp_customize){
    $wp_customize->remove_section('colors');

    // Add Panel Colors
    $wp_customize->add_panel('colors', array(
        'priority' => 15,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__('Colors', 'little-monsters'),
    ));
    /* OpalTool: inject code */
    /* OpalTool: end inject code */
        // Add Section header
    $wp_customize->add_section('littlemonsters_color_header', array(
        'title'      => esc_html__('Header', 'little-monsters'),
        'transport'  => 'postMessage',
        'priority'   => 10,
        'panel'      => 'colors'
    ));    // Add setting header_bg
    $wp_customize->add_setting('littlemonsters_color_header_bg', array(
        'default'    => get_option('littlemonsters_color_header_bg'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control header_bg
    $wp_customize->add_control('littlemonsters_color_header_bg', array(
        'label'    => esc_html__('Header Background', 'little-monsters'),
        'section'  => 'littlemonsters_color_header',
        'type'      => 'color',
    ) );
    // Add setting header_color
    $wp_customize->add_setting('littlemonsters_color_header_color', array(
        'default'    => get_option('littlemonsters_color_header_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control header_color
    $wp_customize->add_control('littlemonsters_color_header_color', array(
        'label'    => esc_html__('Header Color', 'little-monsters'),
        'section'  => 'littlemonsters_color_header',
        'type'      => 'color',
    ) );
    // Add setting headerlink_color
    $wp_customize->add_setting('littlemonsters_color_headerlink_color', array(
        'default'    => get_option('littlemonsters_color_headerlink_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control headerlink_color
    $wp_customize->add_control('littlemonsters_color_headerlink_color', array(
        'label'    => esc_html__('Header Link Color', 'little-monsters'),
        'section'  => 'littlemonsters_color_header',
        'type'      => 'color',
    ) );
    // Add setting headerlink_hover_color
    $wp_customize->add_setting('littlemonsters_color_headerlink_hover_color', array(
        'default'    => get_option('littlemonsters_color_headerlink_hover_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control headerlink_hover_color
    $wp_customize->add_control('littlemonsters_color_headerlink_hover_color', array(
        'label'    => esc_html__('Header Link Hover Color', 'little-monsters'),
        'section'  => 'littlemonsters_color_header',
        'type'      => 'color',
    ) );
    // Add Section breadscrumb
    $wp_customize->add_section('littlemonsters_color_breadscrumb', array(
        'title'      => esc_html__('Breadscrumb', 'little-monsters'),
        'transport'  => 'postMessage',
        'priority'   => 10,
        'panel'      => 'colors'
    ));    // Add setting breadscrumb_bg
    $wp_customize->add_setting('littlemonsters_color_breadscrumb_bg', array(
        'default'    => get_option('littlemonsters_color_breadscrumb_bg'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control breadscrumb_bg
    $wp_customize->add_control('littlemonsters_color_breadscrumb_bg', array(
        'label'    => esc_html__('Breadscrumb BG', 'little-monsters'),
        'section'  => 'littlemonsters_color_breadscrumb',
        'type'      => 'color',
    ) );
    // Add setting breadscrumb_link_hover
    $wp_customize->add_setting('littlemonsters_color_breadscrumb_link_hover', array(
        'default'    => get_option('littlemonsters_color_breadscrumb_link_hover'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control breadscrumb_link_hover
    $wp_customize->add_control('littlemonsters_color_breadscrumb_link_hover', array(
        'label'    => esc_html__('Breadscrumb Link Color', 'little-monsters'),
        'section'  => 'littlemonsters_color_breadscrumb',
        'type'      => 'color',
    ) );
    // Add setting breadscrumb_title
    $wp_customize->add_setting('littlemonsters_color_breadscrumb_title', array(
        'default'    => get_option('littlemonsters_color_breadscrumb_title'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control breadscrumb_title
    $wp_customize->add_control('littlemonsters_color_breadscrumb_title', array(
        'label'    => esc_html__('Breadscrumb Title Color', 'little-monsters'),
        'section'  => 'littlemonsters_color_breadscrumb',
        'type'      => 'color',
    ) );
    // Add Section footer
    $wp_customize->add_section('littlemonsters_color_footer', array(
        'title'      => esc_html__('Footer', 'little-monsters'),
        'transport'  => 'postMessage',
        'priority'   => 10,
        'panel'      => 'colors'
    ));    // Add setting footer_bg
    $wp_customize->add_setting('littlemonsters_color_footer_bg', array(
        'default'    => get_option('littlemonsters_color_footer_bg'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control footer_bg
    $wp_customize->add_control('littlemonsters_color_footer_bg', array(
        'label'    => esc_html__('Footer BG', 'little-monsters'),
        'section'  => 'littlemonsters_color_footer',
        'type'      => 'color',
    ) );
    // Add setting footer_color
    $wp_customize->add_setting('littlemonsters_color_footer_color', array(
        'default'    => get_option('littlemonsters_color_footer_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control footer_color
    $wp_customize->add_control('littlemonsters_color_footer_color', array(
        'label'    => esc_html__('Footer Color', 'little-monsters'),
        'section'  => 'littlemonsters_color_footer',
        'type'      => 'color',
    ) );
    // Add setting heading_color
    $wp_customize->add_setting('littlemonsters_color_heading_color', array(
        'default'    => get_option('littlemonsters_color_heading_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control heading_color
    $wp_customize->add_control('littlemonsters_color_heading_color', array(
        'label'    => esc_html__('Heading Color', 'little-monsters'),
        'section'  => 'littlemonsters_color_footer',
        'type'      => 'color',
    ) );
    // Add Section woocommerce
    $wp_customize->add_section('littlemonsters_color_woocommerce', array(
        'title'      => esc_html__('WooCommerce', 'little-monsters'),
        'transport'  => 'postMessage',
        'priority'   => 10,
        'panel'      => 'colors'
    ));    // Add setting product_bg
    $wp_customize->add_setting('littlemonsters_color_product_bg', array(
        'default'    => get_option('littlemonsters_color_product_bg'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control product_bg
    $wp_customize->add_control('littlemonsters_color_product_bg', array(
        'label'    => esc_html__('Product BG', 'little-monsters'),
        'section'  => 'littlemonsters_color_woocommerce',
        'type'      => 'color',
    ) );
    // Add setting product_name
    $wp_customize->add_setting('littlemonsters_color_product_name', array(
        'default'    => get_option('littlemonsters_color_product_name'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control product_name
    $wp_customize->add_control('littlemonsters_color_product_name', array(
        'label'    => esc_html__('Product Name', 'little-monsters'),
        'section'  => 'littlemonsters_color_woocommerce',
        'type'      => 'color',
    ) );
    // Add setting price_color
    $wp_customize->add_setting('littlemonsters_color_price_color', array(
        'default'    => get_option('littlemonsters_color_price_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control price_color
    $wp_customize->add_control('littlemonsters_color_price_color', array(
        'label'    => esc_html__('Price Color', 'little-monsters'),
        'section'  => 'littlemonsters_color_woocommerce',
        'type'      => 'color',
    ) );
    // Add setting price_old_color
    $wp_customize->add_setting('littlemonsters_color_price_old_color', array(
        'default'    => get_option('littlemonsters_color_price_old_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    // Add Control price_old_color
    $wp_customize->add_control('littlemonsters_color_price_old_color', array(
        'label'    => esc_html__('Price Old Color', 'little-monsters'),
        'section'  => 'littlemonsters_color_woocommerce',
        'type'      => 'color',
    ) );

}
endif;
add_action('customize_register', 'littlemonsters_fnc_customize_register', 99);