<?php
/**
 * Shop breadcrumb
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if (!defined( 'ABSPATH' )) {
    exit;
}
$layout = isset( $_GET['breadcrumb'] ) ? $_GET['breadcrumb'] : littlemonsters_fnc_theme_options( 'breadcrumb_layout', 'no-title' );
if ($layout != 'no-title') {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
}
$bg_breadcrumb = littlemonsters_fnc_theme_options( 'breadcrumb-bg', false );


if (!empty( $breadcrumb )) {
    $delimiter = '<span> > </span>';

    ?>
    <div id="opal-breadscrumb" class="opal-breadscrumb breads-<?php echo esc_attr( $layout ); ?>"
         <?php if ( $bg_breadcrumb ): ?>style="background-image: url(<?php echo esc_attr( $bg_breadcrumb ); ?>)"<?php endif; ?>>
        <div class="container">
            <h2 class="bread-title"><?php echo esc_html( $breadcrumb[count( $breadcrumb ) - 1][0] ); ?></h2>
            <ol class="opal-woocommerce-breadcrumb breadcrumb" <?php echo( is_single() ? 'itemprop="breadcrumb"' : '' ); ?>>
                <?php
                foreach ($breadcrumb as $key => $crumb) {
                    if (!empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1) {
                        echo '<li><a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a></li>';
                    } else {
                        echo '<li>' . esc_html( $crumb[0] ) . '</li>';
                    }
                    if (sizeof( $breadcrumb ) !== $key + 1) {
                        echo trim( $delimiter );
                    }
                    $end = esc_html( $crumb[0] );
                }
                ?>
            </ol>
        </div>
    </div>
    <?php
}
?>


