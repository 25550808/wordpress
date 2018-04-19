<?php
$type = 'recent_products';

$category = '';
extract( $atts );
$_id = time() . rand();

if (isset( $woocategory ) && !empty( $woocategory )) {
    $categories = array_keys( wpopal_themer_autocomplete_options_helper( $woocategory ) );
}
$loop = wpopal_themer_woocommerce_query( $type, $number );
$_count = 0;
?>
    <div class="products-special">
        <h3 class="widget-title"><?php echo littlemonsters_fnc_get_title_type_product( $type ); ?></h3>

        <div class="clearfix"></div>
        <div class="products-collection woocommerce clearfix">
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                <?php if ($_count == 0): ?>
                    <div class="main-product">
                        <?php wc_get_template_part( 'content', 'product-inner' ); ?>
                    </div>
                <?php else: ?>
                    <?php if ($_count == 1): ?>
                        <div class="second-product">
                        <ul class="list-product">
                    <?php endif; ?>

                    <?php wc_get_template_part( 'content', 'product-list' ); ?>

                    <?php if ($_count == $loop->post_count - 1 || $loop->found_posts - 1 == $_count): ?>
                        </ul>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>

                <?php $_count++; ?>
            <?php endwhile; ?>
        </div>
    </div>
<?php wp_reset_postdata(); ?>