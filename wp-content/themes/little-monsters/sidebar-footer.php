<?php
/**
 * The Footer Sidebar
 *
 * @package WpOpal
 * @subpackage Littlemonsters
 * @since Littlemonsters 1.0
 */

?>
<?php if (is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' )) : ?>
    <section class="footer-top">
        <div class="container">
            <div class="row">
                <?php if (is_active_sidebar( 'footer-1' )) : ?>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="wow fadeInUp" data-wow-duration='0.8s' data-wow-delay="200ms">
                            <?php dynamic_sidebar( 'footer-1' ); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar( 'footer-2' )) : ?>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="wow fadeInUp" data-wow-duration='0.8s' data-wow-delay="400ms">
                            <?php dynamic_sidebar( 'footer-2' ); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
 