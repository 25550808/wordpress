<?php global $product; ?>

<?php
$class = $attrs = '';
if (isset( $animate ) && $animate) {
    $class = 'wow fadeInUp';
    //$attrs = 'data-wow-duration="0.6s" data-wow-delay="'.$delay.'ms"';
}
?>

<li class="media product-block widget-product <?php echo esc_attr( $class ); ?>" <?php echo trim( $attrs ); ?>>
    <?php if (( isset( $item_order ) && $item_order == 1 ) || !isset( $item_order )) : ?>
        <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"
           title="<?php echo esc_attr( $product->get_title() ); ?>" class="image pull-left">
            <?php echo trim( $product->get_image() ); ?>
            <?php if (isset( $item_order ) && $item_order == 1) { ?>
                <span class="first-order"><?php echo trim( $item_order ); ?></span>
            <?php } ?>
        </a>
    <?php endif; ?>
    <?php if (isset( $item_order ) && $item_order > 1) { ?>
        <div class="order"><span><?php echo trim( $item_order ); ?></span></div>
    <?php } ?>
    <div class="media-body meta">
        <div class="price"><?php echo( $product->get_price_html() ); ?></div>

        <h3 class="name">
            <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"><?php echo trim( $product->get_title() ); ?></a>
        </h3>
        <?php
        /**
         * woocommerce_after_shop_loop_item_title hook
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */


        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        do_action( 'woocommerce_after_shop_loop_item_title' );
        ?> 
    </div>
</li>


