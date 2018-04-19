<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WpOpal
 * @subpackage Littlemonsters
 * @since Littlemonsters 1.0
 */

$littlemonsters_page_layouts = apply_filters( 'littlemonsters_fnc_get_woocommerce_sidebar_configs', null );

get_header( apply_filters( 'littlemonsters_fnc_get_header_layout', null ) );

?>
<?php do_action( 'littlemonsters_woo_template_main_before' ); ?>

    <div id="main-container">
        <div class="<?php echo apply_filters( 'littlemonsters_template_woocommerce_main_container_class', 'container' ); ?>">
            <div class="row">
                <?php if (isset( $littlemonsters_page_layouts['sidebars'] ) && !empty( $littlemonsters_page_layouts['sidebars'] )) : ?>
                    <?php get_sidebar(); ?>
                <?php endif; ?>

                <div id="main-content"
                     class="main-content col-sm-12 <?php echo esc_attr( $littlemonsters_page_layouts['main']['class'] ); ?>">
                    <div id="primary" class="content-area">
                        <div id="content" class="site-content" role="main">

                            <?php littlemonsters_fnc_woocommerce_content(); ?>

                        </div><!-- #content -->
                    </div><!-- #primary -->


                    <?php get_sidebar( 'content' ); ?>
                </div><!-- #main-content -->

            </div>
        </div>
    </div>
<?php

get_footer();

