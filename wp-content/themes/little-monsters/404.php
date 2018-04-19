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
/*
*Template Name: 404 Page
*/

get_header( apply_filters( 'littlemonsters_fnc_get_header_layout', null ) ); ?>
<?php do_action( 'littlemonsters_template_main_before' ); ?>
    <section id="main-container"
             class="<?php echo apply_filters( 'littlemonsters_template_main_container_class', 'container' ); ?> inner clearfix notfound-page">
        <div class="<?php echo apply_filters( 'littlemonsters_template_main_container_class', 'container' ); ?> inner clearfix ">
            <div class="row">
                <div id="main-content" class="main-content col-lg-12">
                    <div id="primary" class="content-area">
                        <div id="content" class="site-content" role="main">
                            <div class="error-page">
                                <h1 class="title"><?php esc_html_e( '404', 'little-monsters' ); ?></h1>
                                <div class="sub"><?php esc_html_e( 'Oops, that link is broken.', 'little-monsters' ); ?></div>
                                <div class="error-description">
                                    <p><?php esc_html_e( 'Page doesn\'t exist or some other error occured. Go to our', 'little-monsters' ); ?>
                                        <br>
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home page', 'little-monsters' ); ?></a>
                                        <?php esc_html_e( ' or go back to ', 'little-monsters' ); ?>
                                        <a href="javascript: history.go(-1)"><?php esc_html_e( 'Previous page', 'little-monsters' ); ?></a>
                                    </p>
                                </div>
                            </div>
                        </div><!-- #content -->
                    </div><!-- #primary -->
                    <?php get_sidebar( 'content' ); ?>
                </div><!-- #main-content -->


                <?php get_sidebar(); ?>

            </div>
        </div>
        </div>
    </section>
<?php

get_footer();

 