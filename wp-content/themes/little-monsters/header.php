<?php
/**
 * The Header for our theme: Main Darker Background. Logo left + Main menu and Right sidebar. Below Category Search + Mini Shopping basket.
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WpOpal
 * @subpackage Littlemonsters
 * @since Littlemonsters 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <div class="opal-page-inner row-offcanvas row-offcanvas-left">

        <header id="opal-masthead" class="site-header" role="banner">
            <?php get_template_part( 'page-templates/parts/topbar', 'mobile' ); ?> 

            <div class="header-main">
                <div class="<?php echo littlemonsters_fnc_theme_options( 'keepheader' ) ? 'has-sticky' : 'no-sticky'; ?>">
                    <div class="container">
                        <div class="header-inner">
                            <div class="logo-wrapper">
                                <?php get_template_part( 'page-templates/parts/logo' ); ?>
                            </div>
                            <div class="opal-header-right hidden-xs hidden-sm">
                                <?php do_action( 'opal-account-buttons' ); ?>
                                <div id="opal-mainmenu" class="opal-mainmenu">
                                    <?php get_template_part( 'page-templates/parts/nav' ); ?>
                                    <div id="search-container" class="search-box-wrapper pull-right">
                                        <div class="opal-dropdow-search dropdown">
                                            <a data-target=".bs-search-modal-lg" data-toggle="modal" class="search-focus dropdown-toggle dropdown-toggle-overlay"> <i class="fa fa-search"></i></a>
                                            <div class="modal fade bs-search-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                              <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button aria-label="Close" data-dismiss="modal" class="close btn btn-primary pull-right" type="button"><span aria-hidden="true">x</span></button>
                                                      <h4 id="gridSystemModalLabel" class="modal-title"><?php esc_html_e( 'Search', 'little-monsters' ); ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                      <?php get_template_part( 'page-templates/parts/search-overlay' ); ?>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="topcart hidden-xs hidden-sm">
                                <div class="header-cart">

                                    <?php do_action( "littlemonsters_template_header_right" ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- #masthead -->

        <?php do_action( 'littlemonsters_template_header_after' ); ?>

        <section id="main" class="site-main">
