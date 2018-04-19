<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WpOpal
 * @subpackage Littlemonsters
 * @since Littlemonsters 1.0
 */
?>
</section><!-- #main -->
<?php do_action( 'littlemonsters_template_main_after' ); ?>
<?php do_action( 'littlemonsters_template_footer_before' ); ?>
<footer id="opal-footer" class="opal-footer clearfix" role="contentinfo">
    <?php echo littlemonsters_display_footer_content(); ?>
    <?php if (is_active_sidebar( 'mass-footer-body' )): ?>
        <?php get_sidebar( 'mass-footer-body' ); ?>
    <?php endif; ?>
    <?php
    $footer_profile = apply_filters( 'littlemonsters_fnc_get_footer_profile', 'default' );
    $footer_data = littlemonsters_fnc_get_footer_profile_postdata( $footer_profile );
    if (is_object($footer_data) && $footer_data->post_content) {
        $classes = 'buider';
    } else {
        $classes = '';
    }
    ?>
    <section class="opal-copyright clearfix copyright-<?php echo esc_attr( $classes ); ?>">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a href="#" class="scrollup"><i class="fa fa-hand-o-up"></i><?php esc_html_e('To top', 'little-monsters');?></a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <?php littlemonsters_display_footer_copyright(); ?>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                    <?php if(has_nav_menu( 'footermenu' )): ?>
                    <nav class="opal-footermenu" role="navigation">
                        <?php
                            $args = array(
                                'theme_location'  => 'footermenu',
                                'menu_class'      => 'opal-menu-top list-inline',
                                'fallback_cb'     => '',
                                'menu_id'         => 'main-footermenu'
                            );
                            wp_nav_menu($args);
                        ?>
                    </nav>
                    <?php endif; ?>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 text-right">
                    <?php if ( is_active_sidebar( 'social-footer' ) ) : ?>
                        <?php dynamic_sidebar('social-footer'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</footer>
<?php do_action( 'littlemonsters_template_footer_after' ); ?>
<?php get_sidebar( 'offcanvas' ); ?>
</div>
</div>
<!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
