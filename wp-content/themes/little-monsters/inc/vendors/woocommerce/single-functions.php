<?php

/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WpOpal Team <opalwordpress@gmail.com>
 * @copyright  Copyright (C) 2016 http://www.wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */

/**
 * Function For Multi Layouts Single Product
 */
//-----------------------------------------------------
/**
 * Function override the product tabs.
 *
 * @subpackage    Product/Tabs
 */
function woocommerce_output_product_data_tabs() {
    $tab_styles = isset( $_GET['tab'] ) ? $_GET['tab'] : littlemonsters_fnc_theme_options( 'woocommerce-single-tab-style', 'tabs' );
    wc_get_template( 'single-product/tabs/' . $tab_styles . '.php' );
}

/**
 * Set Layout product thumbnails.
 *
 * @subpackage    woocomerce/single-product
 */
if (!function_exists( "littlemonsters_woocommerce_show_product_thumbnails" )) {
    function littlemonsters_woocommerce_show_product_thumbnails($layout) {
        return $layout . '-h';
    }

    add_filter( 'wpopal_themer_woocommerce_show_product_thumbnails', 'littlemonsters_woocommerce_show_product_thumbnails' );
}
/**
 * Set Layout product image.
 *
 * @subpackage    woocomerce/single-product
 */
if (!function_exists( "littlemonsters_woocommerce_show_product_images" )) {
    function littlemonsters_woocommerce_show_product_images($layout) {

        $layouts = isset( $_GET['layout'] ) ? $_GET['layout'] : littlemonsters_fnc_theme_options( 'woocommerce-single-content-layout', '1' );

        $bottoms = array( '1', '2', '5' );
        if (in_array( $layouts, $bottoms )) {
            return $layout . '-bottom';
        } elseif ($layouts == '3') {
            return $layout . '-left';
        } else {
            return $layout . '-h';
        }
    }

    add_filter( 'wpopal_themer_woocommerce_show_product_images', 'littlemonsters_woocommerce_show_product_images' );
}