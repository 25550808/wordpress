<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if (!defined( 'ABSPATH' )) {
    exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if (empty( $woocommerce_loop['loop'] )) {
    $woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if (empty( $woocommerce_loop['columns'] )) {
    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if (!$product || !$product->is_visible()) {
    return;
}

// Increase loop count
$woocommerce_loop['loop']++;


// Extra post classes
$classes = array();
if (0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns']) {
    $classes[] = 'first';
}
if (0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns']) {
    $classes[] = 'last';
}

if ($woocommerce_loop['columns'] == 5) {
    $columns = 'cus-5';
} else {
    $columns = 12 / $woocommerce_loop['columns'];
}
$classes[] = 'col-lg-' . $columns . ' col-md-' . $columns . ' col-sm-' . $columns . ' col-xs-cus-12';
?>
<div <?php post_class( $classes ); ?>>
    <?php wc_get_template_part( 'content', 'product-inner' ); ?>
</div>
