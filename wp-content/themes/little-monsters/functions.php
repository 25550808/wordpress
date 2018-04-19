<?php
/**
 * Littlemonsters functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link https://codex.wordpress.org/Plugin_API
 *
 * @package WpOpal
 * @subpackage Littlemonsters
 * @since Littlemonsters 1.0
 */
define( 'LITTLEMONSTERS_THEME_VERSION', '1.0' );

/**
 * Set up the content width value based on the theme's design.
 *
 * @see littlemonsters_fnc_content_width()
 *
 * @since Littlemonsters 1.0
 */
if (!isset( $content_width )) {
    $content_width = 474;
}

function littlemonsters_fnc_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'littlemonsters_fnc_content_width', 810 );
}

add_action( 'after_setup_theme', 'littlemonsters_fnc_content_width', 0 );


if (!function_exists( 'littlemonsters_fnc_setup' )) :
    /**
     * Littlemonsters setup.
     *
     * Set up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support post thumbnails.
     *
     * @since Littlemonsters 1.0
     */
    function littlemonsters_fnc_setup() {

        /*
         * Make Littlemonsters available for translation.
         *
         * Translations can be added to the /languages/ directory.
         * If you're building a theme based on Littlemonsters, use a find and
         * replace to change 'littlemonsters' to the name of your theme in all
         * template files.
         */
        load_theme_textdomain( 'little-monsters', get_template_directory() . '/languages' );

        // This theme styles the visual editor to resemble the theme style.

        add_editor_style();
        // Add RSS feed links to <head> for posts and comments.
        add_theme_support( 'automatic-feed-links' );

        // Enable support for Post Thumbnails, and declare two sizes.
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 672, 372, true );
        

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'primary' => esc_html__( 'Main menu', 'little-monsters' ),
            'secondary' => esc_html__( 'Menu in left sidebar', 'little-monsters' ),
            'footermenu' => esc_html__('Footer menu', 'little-monsters'),
            'topmenu' => esc_html__( 'Topbar Menu', 'little-monsters' )
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );

        /*
         * Enable support for Post Formats.
         * See https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
        ) );

        // This theme allows users to set a custom background.
        add_theme_support( 'custom-background', apply_filters( 'littlemonsters_fnc_custom_background_args', array(
            'default-color' => 'f5f5f5',
        ) ) );

        // add support for display browser title
        add_theme_support( 'title-tag' );
        // This theme uses its own gallery styles.
        add_filter( 'use_default_gallery_style', '__return_false' );

        littlemonsters_fnc_get_load_plugins();

    }
endif; // littlemonsters_fnc_setup
add_action( 'after_setup_theme', 'littlemonsters_fnc_setup' );

function littlemonsters_themer_get_theme_prefix() {
    return 'littlemonsters_';
}

add_filter( 'wpopal_themer_get_theme_prefix', 'littlemonsters_themer_get_theme_prefix' );
/**
 * Get Theme Option Value.
 *
 * @param String $name : name of prameters
 */
function littlemonsters_fnc_theme_options($name, $default = false) {

    // get the meta from the database
    $options = ( get_option( 'wpopal_theme_options' ) ) ? get_option( 'wpopal_theme_options' ) : null;

    // return the option if it exists
    if (isset( $options[$name] )) {
        return apply_filters( 'wpopal_theme_options_$name', $options[$name] );
    }
    if (get_option( $name )) {
        return get_option( $name );
    }
    // return default if nothing else
    return apply_filters( 'wpopal_theme_options_$name', $default );
}


/**
 * Require function for including 3rd plugins
 *
 */
require_once( get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php' );

function littlemonsters_fnc_get_load_plugins() {

    $plugins[] = ( array(
        'name' => esc_html__( 'MetaBox', 'little-monsters' ),// The plugin name
        'slug' => 'meta-box', // The plugin slug (typically the folder name)
        'required' => true, // If false, the plugin is only 'recommended' instead of required
    ) );


    $plugins[] = ( array(
        'name' => esc_html__( 'MailChimp', 'little-monsters' ),// The plugin name
        'slug' => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
        'required' => true
    ) );

    $plugins[] = ( array(
        'name' => esc_html__( 'Contact Form 7', 'little-monsters' ), // The plugin name
        'slug' => 'contact-form-7', // The plugin slug (typically the folder name)
        'required' => true, // If false, the plugin is only 'recommended' instead of required
    ) );

    $plugins[] = ( array(
        'name' => esc_html__( 'King Composer - Page Builder', 'little-monsters' ),// The plugin name
        'slug' => 'kingcomposer', // The plugin slug (typically the folder name)
        'required' => true

    ) );

    $plugins[] =( array(
        'name'               => esc_html__('Revolution Slider', 'little-monsters'),// The plugin name
        'slug'               => 'revslider',
        'source'             => get_template_directory() . '/plugins/revslider.zip', // The "internal" source of the plugin.
        'required'           => true, // this plugin is required
    ));

    $plugins[] = ( array(
        'name' => esc_html__( 'Wpopal Themer For Themes', 'little-monsters' ),// The plugin name
        'slug' => 'wpopal-themer', // The plugin slug (typically the folder name)
        'required' => true,
        'source' => esc_url( 'http://www.wpopal.com/_opalfw_/wpopal-themer.zip' )
    ) );

    $plugins[] = ( array(
        'name' => esc_html__( 'WooCommerce', 'little-monsters' ), // The plugin name
        'slug' => 'woocommerce', // The plugin slug (typically the folder name)
        'required' => true, // If false, the plugin is only 'recommended' instead of required
    ) );

    $plugins[] = ( array(
        'name' => esc_html__( 'YITH WooCommerce Wishlist', 'little-monsters' ),// The plugin name
        'slug' => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
        'required' => true
    ) );

    $plugins[] = ( array(
        'name' => esc_html__( 'YITH WooCommerce Compare', 'little-monsters' ),// The plugin name
        'slug' => 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
        'required' => true
    ) );

    tgmpa( $plugins );
}

/**
 * Register three Littlemonsters widget areas.
 *
 * @since Littlemonsters 1.0
 */
function littlemonsters_fnc_registart_widgets_sidebars() {

    register_sidebar(
        array(
            'name' => esc_html__( 'Sidebar Default', 'little-monsters' ),
            'id' => 'sidebar-default',
            'description' => esc_html__( 'Appears on posts and pages in the sidebar.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span><span>',
            'after_title' => '</span></span></h3>',
        ) );

    register_sidebar(
        array(
            'name' => esc_html__( 'Vertical Menu', 'little-monsters' ),
            'id' => 'vertical-menu',
            'description' => esc_html__( 'Appears in the hearder section of the site.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ) );

    register_sidebar(
        array(
            'name' => esc_html__( 'Social Header', 'little-monsters' ),
            'id' => 'social-header',
            'description' => esc_html__( 'Appears in the hearder section of the site.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="social-header clearfix %2$s">',
            'after_widget' => '</aside>',
        ) );

    register_sidebar(
        array(
            'name' => esc_html__( 'Blog Left Sidebar', 'little-monsters' ),
            'id' => 'blog-sidebar-left',
            'description' => esc_html__( 'Appears on posts and pages in the sidebar.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span><span>',
            'after_title' => '</span></span></h3>',
        ) );

    register_sidebar(
        array(
            'name' => esc_html__( 'Blog Right Sidebar', 'little-monsters' ),
            'id' => 'blog-sidebar-right',
            'description' => esc_html__( 'Appears on posts and pages in the sidebar.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span><span>',
            'after_title' => '</span></span></h3>',
        ) );

    register_sidebar(
        array(
            'name' => esc_html__( 'Woo Left Sidebar', 'little-monsters' ),
            'id' => 'woo-sidebar-left',
            'description' => esc_html__( 'Appears on woocommerce and pages in the sidebar.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span><span>',
            'after_title' => '</span></span></h3>',
        ) );

    register_sidebar(
        array(
            'name' => esc_html__( 'Woo Right Sidebar', 'little-monsters' ),
            'id' => 'woo-sidebar-right',
            'description' => esc_html__( 'Appears on woocommerce and pages in the sidebar.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span><span>',
            'after_title' => '</span></span></h3>',
        ) );
    register_sidebar( 
        array(
            'name'          => esc_html__( 'Static Left Sidebar', 'little-monsters'),
            'id'            => 'static-sidebar-left',
            'description'   => esc_html__( 'Appears on posts and pages in the sidebar static left with header static be actived.', 'little-monsters'),
            'before_widget' => '<aside id="%1$s" class="widget widget-static clearfix %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title"><span><span>',
            'after_title'   => '</span></span></h3>',
        ));
    register_sidebar(
        array(
            'name' => esc_html__( 'Single Product Sidebar', 'little-monsters' ),
            'id' => 'single-product-sidebar',
            'description' => esc_html__( 'Appears on woocommerce and pages in the sidebar.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span><span>',
            'after_title' => '</span></span></h3>',
        ) );

    register_sidebar(
        array(
            'name' => esc_html__( 'Footer 1', 'little-monsters' ),
            'id' => 'footer-1',
            'description' => esc_html__( 'Appears in the footer section of the site.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
    register_sidebar(
        array(
            'name' => esc_html__( 'Footer 2', 'little-monsters' ),
            'id' => 'footer-2',
            'description' => esc_html__( 'Appears in the footer section of the site.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
    register_sidebar(
        array(
            'name' => esc_html__( 'Footer 3', 'little-monsters' ),
            'id' => 'footer-3',
            'description' => esc_html__( 'Appears in the footer section of the site.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
    register_sidebar(
        array(
            'name' => esc_html__( 'Footer 4', 'little-monsters' ),
            'id' => 'footer-4',
            'description' => esc_html__( 'Appears in the footer section of the site.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
    register_sidebar(
        array(
            'name' => esc_html__( 'Footer 5', 'little-monsters' ),
            'id' => 'footer-5',
            'description' => esc_html__( 'Appears in the footer section of the site.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

    register_sidebar(
        array(
            'name' => esc_html__( 'Social footer', 'little-monsters' ),
            'id' => 'social-footer',
            'description' => esc_html__( 'Appears in the end of footer section of the site.', 'little-monsters' ),
            'before_widget' => '<aside id="%1$s" class="widget-footer clearfix %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title hide"><span>',
            'after_title' => '</span></h3>',
        ) );
}

add_action( 'widgets_init', 'littlemonsters_fnc_registart_widgets_sidebars' );

/**
 * Register Lato Google font for Littlemonsters.
 *
 * @since Littlemonsters 1.0
 *
 * @return string
 */
function littlemonsters_fnc_font_url() {

    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $teko = _x( 'on', 'Teko font: on or off', 'little-monsters' );

    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $raleway = _x( 'on', 'Raleway font: on or off', 'little-monsters' );
    $playfair = _x( 'on', 'Playfair Display font: on or off', 'little-monsters' );

    if ('off' !== $teko || 'off' !== $raleway || 'off' !== $playfair) {
        $font_families = array();

        if ('off' !== $teko) {
            $font_families[] = 'Teko:300,400,500,600,700';
        }

        if ('off' !== $raleway) {
            $font_families[] = 'Poppins:300,400,500,600,700';
        }

        if ('off' !== $playfair) {
            $font_families[] = 'Playfair+Display:400,400i,700,700i,900,900i';
        }

        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );


        $protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol . '//fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Littlemonsters 1.0
 */
function littlemonsters_fnc_scripts() {
    $prefixRTL = '';
    if (is_rtl()) {
        $prefixRTL = 'rtl-';
    }
    // Add Lato font, used in the main stylesheet.
    wp_enqueue_style( 'open-sanss', littlemonsters_fnc_font_url(), array(), null );

    // Add Genericons font, used in the main stylesheet.
    wp_enqueue_style( 'font-fa', get_template_directory_uri() . '/css/' . $prefixRTL . 'font-awesome.min.css', array(), '3.0.3' );

    if (isset( $_GET['opal-skin'] ) && $_GET['opal-skin']) {
        $currentSkin = $_GET['opal-skin'];
    } else {
        $currentSkin = str_replace( '.css', '', littlemonsters_fnc_theme_options( 'skin', 'default' ) );
    }

    if (!empty( $currentSkin ) && $currentSkin != 'default') {
        wp_enqueue_style( 'littlemonsters-' . $currentSkin . '-style', get_template_directory_uri() . '/css/skins/' . $currentSkin . '/' . $prefixRTL . 'style.css' );
    } else {
        // Load our main stylesheet.
        wp_enqueue_style( 'littlemonsters-style', get_template_directory_uri() . '/css/' . $prefixRTL . 'style.css' );
    }

    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style( 'littlemonsters-ie', get_template_directory_uri() . '/css/' . $prefixRTL . 'ie.css', array( 'littlemonsters-style' ), '20131205' );
    wp_style_add_data( 'littlemonsters-ie', 'conditional', 'lt IE 9' );


    wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20130402' );

    if (is_singular() && comments_open() && get_option( 'thread_comments' )) {
        wp_enqueue_script( 'comment-reply' );
    }

    if (is_singular() && wp_attachment_is_image()) {
        wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
    }
    //---

    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js', array( 'jquery' ), '20150315', true );
    wp_enqueue_script( 'prettyphoto-js', get_template_directory_uri() . '/js/jquery.prettyPhoto.js' );
    wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/' . $prefixRTL . 'prettyPhoto.css' );

    wp_enqueue_script( 'littlemonsters-functions-js', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150315', true );
    wp_localize_script( 'littlemonsters-functions-js', 'littlemonstersAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

}

add_action( 'wp_enqueue_scripts', 'littlemonsters_fnc_scripts', 9999 );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Littlemonsters 1.0
 */
function littlemonsters_fnc_admin_fonts() {
    wp_enqueue_style( 'littlemonsters-lato', littlemonsters_fnc_font_url(), array(), null );
}

add_action( 'admin_print_scripts-appearance_page_custom-header', 'littlemonsters_fnc_admin_fonts' );


require_once( get_template_directory() . '/inc/customizer.php' );
require_once( get_template_directory() . '/inc/custom-customizer.php' );
require_once( get_template_directory() . '/inc/custom-header.php' );
require_once( get_template_directory() . '/inc/function-post.php' );
require_once( get_template_directory() . '/inc/functions-import.php' );
require_once( get_template_directory() . '/inc/template-tags.php' );
require_once( get_template_directory() . '/inc/template.php' );


/**
 * Check and load to support wpopal-themer
 */
if (in_array( 'wpopal-themer/wpopal-themer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
    if (class_exists( 'Wpopal_User_Account' )) {
        new Wpopal_User_Account();
    }

}
/**
 * Check and load to support kingcomposer
 */
if (in_array( 'kingcomposer/kingcomposer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
    require_once( get_template_directory() . '/inc/vendors/kingcomposer/functions.php' );
}

/**
 * Check to support woocommerce
 */
if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
    add_theme_support( 'woocommerce' );
    require_once( get_template_directory() . '/inc/vendors/woocommerce/functions.php' );
    require_once( get_template_directory() . '/inc/vendors/woocommerce/single-functions.php' );
}