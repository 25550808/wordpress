<?php
global $product;
$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'blog-thumbnails' );
$littlemonsters_sale = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
?>

<div class="product-block" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
    <figure class="image">
        <span class="sale-off">
            <?php
            $percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
            echo '-' . trim( $percentage ) . '%';
            ?>
        </span>
        <?php echo trim( $product->get_image( 'image-widgets' ) ); ?>
        <?php if (littlemonsters_fnc_theme_options( 'is-quickview', true )) { ?>
            <div class="quick-view hidden-xs">
                <a title="<?php esc_html_e( 'Quick view', 'little-monsters' ); ?>" href="#" class="quickview"
                   data-productslug="<?php echo trim( $product->get_slug() ); ?>" data-toggle="modal"
                   data-target="#opal-quickview-modal">
                    <i class="fa fa-eye"> </i><span><?php esc_html_e( 'Quick view', 'little-monsters' ); ?></span>
                </a>
            </div>
        <?php } ?>
    </figure>

    <div class="caption">
        <div class="meta">
            <div class="time">
                <?php if ($littlemonsters_sale) { ?>
                    <div class="pts-countdown clearfix" data-countdown="countdown"
                         data-date="<?php echo date( 'm', $littlemonsters_sale ) . '-' . date( 'd', $littlemonsters_sale ) . '-' . date( 'Y', $littlemonsters_sale ) . '-' . date( 'H', $littlemonsters_sale ) . '-' . date( 'i', $littlemonsters_sale ) . '-' . date( 's', $littlemonsters_sale ); ?>">
                    </div>
                <?php } ?>
            </div>
            <h3 class="name">
                <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"><?php echo esc_attr( $product->get_title() ); ?></a>
            </h3>
            <div class="rating clearfix ">
                <?php if ($rating_html = wc_get_rating_html( $product->get_average_rating() )) { ?>
                    <div><?php echo trim( $rating_html ); ?></div>
                <?php } else { ?>
                    <div class="star-rating"></div>
                <?php } ?>
            </div>
            <div class="price"><?php echo trim( $product->get_price_html() ); ?></div>
        </div>
    </div>
    <div class="button-action button-groups clearfix">
        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
        <?php if (class_exists( 'YITH_WCWL' )) { ?>
            <?php littlemonsters_yith_wcwl_add_wishlist_on_loop(); ?>
        <?php } ?>

        <?php if (class_exists( 'YITH_Woocompare' )) { ?>
            <?php littlemonsters_compare_shortcode(); ?>
        <?php } ?>
    </div>

    
</div>


