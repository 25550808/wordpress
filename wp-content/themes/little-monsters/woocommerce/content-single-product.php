<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.0.0
 */

if (!defined( 'ABSPATH' )) {
    exit; // Exit if accessed directly
}

?>

<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if (post_password_required()) {
    echo get_the_password_form();
    return;
}
?>
<?php
$layouts = isset( $_GET['layout'] ) ? $_GET['layout'] : littlemonsters_fnc_theme_options( 'woocommerce-single-content-layout', '1' );

if (!empty( $layouts ) && is_file( get_template_directory() . '/woocommerce/single-product/layouts/layout_' . $layouts . '.php' )) {
    wc_get_template_part( 'woocommerce/single-product/layouts/layout_' . $layouts );
} else {
    wc_get_template_part( 'woocommerce/single-product/layouts/layout_1' );
}
?>
<?php do_action( 'woocommerce_after_single_product' ); ?>
