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
    <div class="widget-products-list">
        <h3 class="widget-title"><?php echo littlemonsters_fnc_get_title_type_product( $type ); ?></h3>
        <div class="clearfix"></div>
        <div class="products-collection woocommerce clearfix">
            <ul class="list-product">
                <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                    <?php wc_get_template_part( 'content', 'product-list' ); ?>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
<?php wp_reset_postdata(); ?>