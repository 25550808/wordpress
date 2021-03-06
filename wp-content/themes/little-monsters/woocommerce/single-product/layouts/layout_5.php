<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

/**
 * Layout Left Thumbnail
 */
if (!defined( 'ABSPATH' )) {
    exit; // Exit if accessed directly
}

?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="product-info clearfix single-layout5">
        
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <?php
                /**
                 * woocommerce_before_single_product_summary hook
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_meta', 25 );
                add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_excerpt', 23 );
                do_action( 'woocommerce_before_single_product_summary' );
                ?>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="single-product-summary clearfix">
                    <?php
                    /**
                     * woocommerce_single_product_summary hook
                     *
                     * @hooked woocommerce_template_single_title - 5
                     * @hooked woocommerce_template_single_rating - 10
                     * @hooked woocommerce_template_single_price - 10
                     * @hooked woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     * @hooked woocommerce_template_single_sharing - 50
                     */
                    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
                    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
                    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
                    add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 40 );
                    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 4 );
                    do_action( 'woocommerce_single_product_summary' );
                    ?>
                </div>

                <?php
                /**
                 * @hooked littlemonsters_fnc_woocommerce_share_box - 25
                 */
                do_action( 'littlemonsters_woocommerce_after_single_product_summary' ); ?>
            </div>


        </div>
    </div>
    <?php
    /**
     * woocommerce_after_single_product_summary hook
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    do_action( 'woocommerce_after_single_product_summary' );
    ?>

    <meta itemprop="url" content="<?php the_permalink(); ?>"/>
</div><!-- #product-<?php the_ID(); ?> -->