<?php

/**
 * Load woocommerce styles follow theme skin actived
 *
 * @static
 * @access public
 * @since Wpopal_Themer 1.0
 */
function littlemonsters_fnc_woocommerce_load_media() {
    $prefixRTL = '';
    if (is_rtl()) {
        $prefixRTL = 'rtl-';
    }

    if (isset( $_GET['opal-skin'] ) && $_GET['opal-skin']) {
        $current = $_GET['opal-skin'];
    } else {
        $current = str_replace( '.css', '', littlemonsters_fnc_theme_options( 'skin', 'default' ) );
    }

    if ($current == 'default') {
        $path = get_template_directory_uri() . '/css/' . $prefixRTL . 'woocommerce.css';
    } else {
        $path = get_template_directory_uri() . '/css/skins/' . $current . '/' . $prefixRTL . 'woocommerce.css';
    }
    wp_enqueue_style( 'littlemonsters-woocommerce', $path, 'littlemonsters-woocommerce-front', LITTLEMONSTERS_THEME_VERSION, 'all' );
}

add_action( 'wp_enqueue_scripts', 'littlemonsters_fnc_woocommerce_load_media', 15 );


/**
 * func override product config zoom
 */
add_filter( 'wpopal_filter_product_config_zoom', 'littlemonsters_fnc_woocommerce_config_zoom' );

function littlemonsters_fnc_woocommerce_config_zoom() {
    return array(
        'product_enablezoom' => 1,
        'product_zoommode' => 'inner',
        'product_zoomeasing' => 1,
        'product_zoomlensshape' => "square",
        'product_zoomlenssize' => "200",
        'product_zoomgallery' => 0,
        'enable_product_customtab' => 0,
        'product_customtab_name' => '',
        'product_customtab_content' => '',
        'product_related_column' => 0,
    );
}


/**
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'littlemonsters_fnc_woocommerce_header_add_to_cart_fragment' );

function littlemonsters_fnc_woocommerce_header_add_to_cart_fragment($fragments) {
    global $woocommerce;

    $fragments['#cart .mini-cart-items'] = sprintf( '<span class="mini-cart-items">(%d)</span> ', $woocommerce->cart->cart_contents_count );
    $fragments['#cart .mini-cart .amount'] = trim( $woocommerce->cart->get_cart_total() );
    return $fragments;
}

add_filter( 'yith_wcwl_button_label', 'littlemonsters_fnc_wpo_woocomerce_icon_wishlist' );
add_filter( 'yith-wcwl-browse-wishlist-label', 'littlemonsters_fnc_wpo_woocomerce_icon_wishlist_add' );

function littlemonsters_fnc_wpo_woocomerce_icon_wishlist($value = '') {
    return '<i class="fa fa-heart-o"></i><span>' . esc_html__( 'Wishlist', 'little-monsters' ) . '</span>';
}

function littlemonsters_fnc_wpo_woocomerce_icon_wishlist_add() {
    return '<i class="fa fa-heart-o"></i><span>' . esc_html__( 'Wishlist', 'little-monsters' ) . '</span>';
}

//---------------------------------------------------------------------------------------------
function littlemonsters_compare_shortcode(){
    global $product;
	$action_add = 'yith-woocompare-add-product';
    $url_args = array(
        'action' => $action_add,
        'id' => $product->get_id()
    );
?>
    <div class="woocommerce product compare-button">
        <a href="<?php echo wp_nonce_url( add_query_arg( $url_args ), $action_add ); ?>" class="compare button" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" rel="nofollow">
            <i class="fa fa-bar-chart-o"></i>
            <span><?php esc_html_e( 'Compare', 'little-monsters' ); ?></span>
        </a>
    </div>
<?php
}
add_action( 'woocommerce_after_add_to_cart_button', 'littlemonsters_compare_shortcode', 14 );

//----------------------------------------------------------------------------------------------

if (defined( 'YITH_WCWL' ) && !function_exists( 'yith_wcwl_add_wishlist_on_loop' )) {
    function littlemonsters_yith_wcwl_add_wishlist_on_loop() {
        global $product;
?>
        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr( $product->get_id() ); ?>">
            <div class="yith-wcwl-add-button show">
                <a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product->get_id()) )?>" rel="nofollow" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>" data-product-type="<?php echo esc_attr( $product->get_type() ); ?>" class="add_to_wishlist" >
                    <em class="fa fa-heart-o"></em>
                    <span><?php esc_html_e( 'Add to wishlist', 'little-monsters' ); ?></span>
                </a>
                <img src="<?php echo esc_url( YITH_WCWL_URL . 'assets/images/wpspin_light.gif' ) ?>" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
            </div>
        </div>
<?php
    }

    add_action( 'woocommerce_after_add_to_cart_button', 'littlemonsters_yith_wcwl_add_wishlist_on_loop', 15 );

}//----------------------------------------------------------------------------------------------
/**
 * Mini Basket
 */
if (!function_exists( 'littlemonsters_fnc_minibasket' )) {
    function littlemonsters_fnc_minibasket($style = '') {
        $template = apply_filters( 'littlemonsters_fnc_minibasket_template', littlemonsters_fnc_get_header_layout( '' ) );

        return get_template_part( 'woocommerce/cart/mini-cart-button', $template );
    }
}
if (littlemonsters_fnc_theme_options( "woo-show-minicart", true )) {
    add_action( 'littlemonsters_template_header_right', 'littlemonsters_fnc_minibasket', 30, 0 );
}
/******************************************************
 *                                                      *
 * Hook functions applying in archive, category page  *
 *                                                      *
 ******************************************************/
function littlemonsters_template_woocommerce_main_container_class($class) {
    if (is_product()) {
        $class .= ' ' . littlemonsters_fnc_theme_options( 'woocommerce-single-layout' );
    } else {
        if (is_product_category() || is_archive()) {
            $class .= ' ' . littlemonsters_fnc_theme_options( 'woocommerce-archive-layout' );
        }
    }
    return $class;
}

add_filter( 'littlemonsters_template_woocommerce_main_container_class', 'littlemonsters_template_woocommerce_main_container_class' );
function littlemonsters_fnc_get_woocommerce_sidebar_configs($configs = '') {
    global $post;
    $right = null;
    $left = null;
    $layout = false;
    if (is_product()) {
        $left = littlemonsters_fnc_theme_options( 'woocommerce-single-left-sidebar' );
        $right = littlemonsters_fnc_theme_options( 'woocommerce-single-right-sidebar' );
        $layout = littlemonsters_fnc_theme_options( 'woocommerce-single-layout' );
    } else {
        if (is_product_category() || is_archive()) {
            $left = littlemonsters_fnc_theme_options( 'woocommerce-archive-left-sidebar' );
            $right = littlemonsters_fnc_theme_options( 'woocommerce-archive-right-sidebar' );
            $layout = littlemonsters_fnc_theme_options( 'woocommerce-archive-layout' );
        }
    }

    return littlemonsters_fnc_get_layout_configs( $left, $right, $layout );
}

add_filter( 'littlemonsters_fnc_get_woocommerce_sidebar_configs', 'littlemonsters_fnc_get_woocommerce_sidebar_configs', 1, 1 );


function littlemonsters_woocommerce_breadcrumb_defaults($args) {
    $args['wrap_before'] = '<div class="opal-breadscrumb"><div class="container"><ol class="opal-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
    $args['wrap_after'] = '</ol></div></div>';

    return $args;
}

add_filter( 'woocommerce_breadcrumb_defaults', 'littlemonsters_woocommerce_breadcrumb_defaults' );

add_action( 'littlemonsters_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );
/**
 * Remove show page results which display on top left of listing products block.
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 10 );


function littlemonsters_fnc_woocommerce_after_shop_loop_start() {
    echo '<div class="products-bottom-wrap clearfix">';
}

add_action( 'woocommerce_after_shop_loop', 'littlemonsters_fnc_woocommerce_after_shop_loop_start', 1 );

function littlemonsters_fnc_woocommerce_after_shop_loop_after() {
    echo '</div>';
}

add_action( 'woocommerce_after_shop_loop', 'littlemonsters_fnc_woocommerce_after_shop_loop_after', 10000 );


/**
 * Wrapping all elements are wrapped inside Div Container which rendered in woocommerce_before_shop_loop hook
 */
function littlemonsters_fnc_woocommerce_before_shop_loop_start() {
    echo '<div class="products-top-wrap clearfix">';
}

function littlemonsters_fnc_woocommerce_before_shop_loop_end() {
    echo '</div>';
}


add_action( 'woocommerce_before_shop_loop', 'littlemonsters_fnc_woocommerce_before_shop_loop_start', 0 );
add_action( 'woocommerce_before_shop_loop', 'littlemonsters_fnc_woocommerce_before_shop_loop_end', 1000 );


function littlemonsters_fnc_woocommerce_display_modes() {
    $woo_display = 'grid';
    if (isset( $_GET['display'] )) {
        $woo_display = $_GET['display'];
    }
    echo '<form class="display-mode" method="get">';
    echo '<button title="' . esc_html__( 'Grid', 'little-monsters' ) . '" class="btn ' . ( $woo_display == 'grid' ? 'active' : '' ) . '" value="grid" name="display" type="submit"><i class="fa fa-th"></i></button>';
    echo '<button title="' . esc_html__( 'List', 'little-monsters' ) . '" class="btn ' . ( $woo_display == 'list' ? 'active' : '' ) . '" value="list" name="display" type="submit"><i class="fa fa-th-list"></i></button>';
    // Keep query string vars intact
    foreach ($_GET as $key => $val) {
        if ('display' === $key || 'submit' === $key) {
            continue;
        }
        if (is_array( $val )) {
            foreach ($val as $innerVal) {
                echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
            }

        } else {
            echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
        }
    }
    echo '</form>';

}

add_action( 'woocommerce_before_shop_loop', 'littlemonsters_fnc_woocommerce_display_modes', 20 );


/**
 * Processing hook layout content
 */
function littlemonsters_fnc_layout_main_class($class) {
    $sidebar = littlemonsters_fnc_theme_options( 'woo-sidebar-show', 1 );
    if (is_single()) {
        $sidebar = littlemonsters_fnc_theme_options( 'woo-single-sidebar-show' );;
    } else {
        $sidebar = littlemonsters_fnc_theme_options( 'woo-sidebar-show' );
    }

    if ($sidebar) {
        return $class;
    }

    return 'col-lg-12 col-md-12 col-xs-12';
}

add_filter( 'littlemonsters_woo_layout_main_class', 'littlemonsters_fnc_layout_main_class', 4 );


/**
 *
 */
function littlemonsters_fnc_woocommerce_archive_image() {
    if (is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0) {
        $thumb = get_woocommerce_term_meta( get_queried_object()->term_id, 'thumbnail_id', true );

        if ($thumb) {
            $img = wp_get_attachment_image_src( $thumb, 'full' );

            echo '<p class="category-banner"><img src="' . $img[0] . '""></p>';
        }
    }
}

add_action( 'woocommerce_archive_description', 'littlemonsters_fnc_woocommerce_archive_image', 9 );

/***************************************************
 *                                                   *
 * Hook functions applying in single product page  *
 *                                                   *
 ***************************************************/


/**
 * Remove review to products tabs. and display this as block below the tab.
 */
function littlemonsters_fnc_woocommerce_product_tabs($tabs) {

    if (isset( $tabs['reviews'] )) {
        //		unset( $tabs['reviews'] );
    }
    return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'littlemonsters_fnc_woocommerce_product_tabs', 99 );

/**
 * Rehook product review products in woocommerce_after_single_product_summary
 */
function littlemonsters_fnc_product_reviews() {
    return comments_template();
}

//add_action('woocommerce_after_single_product_summary','littlemonsters_fnc_product_reviews', 10 );

//remove heading tab single product
add_filter( 'woocommerce_product_description_heading',
    'sam_product_description_heading' );

function sam_product_description_heading() {
    return '';
}


/**
 * Show/Hide related, upsells products
 */
function littlemonsters_woocommerce_related_upsells_products($located, $template_name) {
    $options = get_option( 'wpopal_theme_options' );
    $content_none = get_template_directory() . '/woocommerce/content-none.php';

    if ('single-product/related.php' == $template_name) {
        if (isset( $options['wc_show_related'] ) &&
            ( 1 == $options['wc_show_related'] )
        ) {
            $located = $content_none;
        }
    } elseif ('single-product/up-sells.php' == $template_name) {
        if (isset( $options['wc_show_upsells'] ) &&
            ( 1 == $options['wc_show_upsells'] )
        ) {
            $located = $content_none;
        }
    }

    return apply_filters( 'littlemonsters_woocommerce_related_upsells_products', $located, $template_name );
}

add_filter( 'wc_get_template', 'littlemonsters_woocommerce_related_upsells_products', 10, 2 );

/**
 * Number of products per page
 */
function littlemonsters_woocommerce_shop_per_page($number) {
    $value = littlemonsters_fnc_theme_options( 'woo-number-page', get_option( 'posts_per_page' ) );
    if (is_numeric( $value ) && $value) {
        $number = absint( $value );
    }
    return $number;
}

add_filter( 'loop_shop_per_page', 'littlemonsters_woocommerce_shop_per_page' );

/**
 * Number of products per row
 */
function littlemonsters_woocommerce_shop_columns($number) {
    $value = littlemonsters_fnc_theme_options( 'wc_itemsrow', 4 );
    if (in_array( $value, array( 2, 3, 4, 6 ) )) {
        $number = $value;
    }
    return $number;
}

add_filter( 'loop_shop_columns', 'littlemonsters_woocommerce_shop_columns' );

/**
 *
 */
function littlemonsters_fnc_woocommerce_share_box() {
    if( class_exists('WpopalFrameworkThemer') && littlemonsters_fnc_theme_options( 'wc_show_share_social', 1 ) ){
        wpopal_themer_get_template_part( 'sharebox' );
    }
}

add_action( 'littlemonsters_woocommerce_after_single_product_summary', 'littlemonsters_fnc_woocommerce_share_box', 25 );

/**
 *
 */
function littlemonsters_fnc_woo_product_nav() {
    $prev = get_previous_post();
    $next = get_next_post();

    echo '<div class="product-single-nav hidden-md hidden-sm hidden-xs">';
    littlemonsters_render_product_nav($prev, 'left');
    littlemonsters_render_product_nav($next, 'right');
    echo '</div>';
}
add_action( 'woocommerce_single_product_summary', 'littlemonsters_fnc_woo_product_nav', 1 );

function littlemonsters_render_product_nav($post, $position){
    if($post){
        $product = wc_get_product($post->ID);
        $img = '';
        if(has_post_thumbnail($post)){
            $img = get_the_post_thumbnail($post, 'shop_thumbnail');
        }
        $link = get_permalink($post);
        echo "<div class='{$position} psnav'>";
        echo ($position == 'left')?$img:'';    
        echo "  <div class='product_single_nav_inner single_nav'>
                    <a href=\"{$link}\">
                        <span class='name'>{$post->post_title}</span>
                    </a>
                    <span class='price'>{$product->get_price_html()}</span>
                </div>";
        echo ($position == 'right')?$img:'';    
        echo "</div>";
    }
}


// rating price


//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 11 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 1 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );


//remove_action( 'littlemonsters_woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
//add_action( 'littlemonsters_woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );

/* ---------------------------------------------------------------------------
 * WooCommerce - Function get Query
 * --------------------------------------------------------------------------- */

function littlemonsters_fnc_get_review_counting() {

    global $post;
    $output = array();

    for ($i = 1; $i <= 5; $i++) {
        $args = array(
            'post_id' => ( $post->ID ),
            'meta_query' => array(
                array(
                    'key' => 'rating',
                    'value' => $i
                )
            ),
            'count' => true
        );
        $output[$i] = get_comments( $args );
    }
    return $output;
}


/* ---------------------------------------------------------------------------
 * WooCommerce - Function get Query
 * --------------------------------------------------------------------------- */


function littlemonsters_fnc_woocommerce_before_shop_loop_item_title() {

    global $product;

    if ($product->get_regular_price()) {
        $percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
        echo '<span class="product-sale-label">-' . trim( $percentage ) . '%</span>';
    }

}


if (!function_exists( 'littlemonsters_fnc_woocommerce_content' )) {

    /**
     * Output WooCommerce content.
     *
     * This function is only used in the optional 'woocommerce.php' template
     * which people can add to their themes to add basic woocommerce support
     * without hooks or modifying core templates.
     *
     */
    function littlemonsters_fnc_woocommerce_content() {

        if (is_singular( 'product' )) {

            while (have_posts()) : the_post();

                wc_get_template_part( 'content', 'single-product' );

            endwhile;

        } else { ?>

            <?php if (apply_filters( 'woocommerce_show_page_title', true )) : ?>

                <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

            <?php endif; ?>

            <?php do_action( 'woocommerce_archive_description' ); ?>

            <?php if (have_posts()) : ?>

                <?php do_action( 'woocommerce_before_shop_loop' ); ?>

                <div class="childrens clear">
                    <?php woocommerce_product_subcategories(); ?>
                </div>

                <?php woocommerce_product_loop_start(); ?>


                <?php while (have_posts()) : the_post(); ?>

                    <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php do_action( 'woocommerce_after_shop_loop' ); ?>

            <?php elseif (!woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) )) : ?>

                <?php wc_get_template( 'loop/no-products-found.php' ); ?>

            <?php endif;

        }
    }
}


function littlemonsters_fnc_get_title_type_product($type) {
    $_types = array(
        'recent_products' => esc_html__( 'Recent Products', 'little-monsters' ),
        'sale_products' => esc_html__( 'On Sale ', 'little-monsters' ),
        'featured_products' => esc_html__( 'Featured Products', 'little-monsters' ),
        'best_selling_products' => esc_html__( 'Best Sellers', 'little-monsters' ),
        'products' => esc_html__( 'Products', 'little-monsters' ),
    );
    foreach ($_types as $key => $val) {
        if ($type == $key) {
            return $val;
        }
    }
}

