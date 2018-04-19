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

$atts = array_merge( array(
    'number_post' => 8,
    'columns' => 4,
    'type' => 'recent_products',
    'category' => '',
), $atts );

extract( $atts );

$loop = wpopal_themer_woocommerce_query( 'deals', $number_post );
$_id = wpopal_themer_makeid();
$_count = 0;

if( $columns == 5 ){
    $columns = 4;
}
$scolumn = $columns > 0 ? 12/$columns : 3;
$classes = 'col-md-'.$scolumn.' col-sm-6 col-xs-12 product-col';

if ($loop->have_posts()) { ?>
    <div class=" products-collection woocommerce woo-deals">
        <div class="inner owl-carousel-play">
            <div class="rows-products">
                <?php while ($loop->have_posts()) : $loop->the_post();
                    $product = wc_get_product();

                ?>
                <div class="<?php echo esc_attr( $classes ); ?><?php echo ($_count++%$columns==0)? ' first' : '';?>">
                    <?php wc_get_template_part( 'content-product', 'deal'); ?>
                </div>

                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>

<?php }