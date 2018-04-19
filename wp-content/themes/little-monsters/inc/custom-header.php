<?php
/**
 * Implement Custom Header functionality for Littlemonsters
 *
 * @package WpOpal
 * @subpackage Littlemonsters
 * @since Littlemonsters 1.0
 */

/**
 * Set up the WordPress core custom header settings.
 *
 * @since Littlemonsters 1.0
 *
 * @uses littlemonsters_fnc_header_style()
 * @uses littlemonsters_fnc_admin_header_style()
 * @uses littlemonsters_fnc_admin_header_image()
 */
function littlemonsters_fnc_custom_header_setup() {
	/**
	 * Filter Littlemonsters custom-header support arguments.
	 *
	 * @since Littlemonsters 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type bool   $header_text            Whether to display custom header text. Default false.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 1260.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 240.
	 *     @type bool   $flex_height            Whether to allow flexible-height header images. Default true.
	 *     @type string $admin_head_callback    Callback function used to style the image displayed in
	 *                                          the Appearance > Header screen.
	 *     @type string $admin_preview_callback Callback function used to create the custom header markup in
	 *                                          the Appearance > Header screen.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'littlemonsters_fnc_custom_header_args', array(
		'default-text-color'     => 'fff',
		'width'                  => 1260,
		'height'                 => 240,
		'flex-height'            => true,
		'wp-head-callback'       => 'littlemonsters_fnc_header_style',
		'admin-head-callback'    => 'littlemonsters_fnc_admin_header_style',
		'admin-preview-callback' => 'littlemonsters_fnc_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'littlemonsters_fnc_custom_header_setup' );

if ( ! function_exists( 'littlemonsters_fnc_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see littlemonsters_fnc_custom_header_setup().
 *
 */
function littlemonsters_fnc_header_style() {  
    ?>
    <style type="text/css" id="littlemonsters-header-css">
        
        <?php
        $header_bg = get_option('littlemonsters_color_header_bg');
        if( !empty($header_bg) && preg_match("#\##", $header_bg) ) : ?>
            .opal-page-inner .site-header{
                background-color:<?php echo esc_attr($header_bg); ?>;
            }
        <?php endif; ?>

        <?php
        $header_color = get_option('littlemonsters_color_header_color');
        if( !empty($header_color) && preg_match("#\##", $header_color) ) : ?>
            .opal-page-inner .site-header{
                color:<?php echo esc_attr($header_color); ?>;
            }
        <?php endif; ?>

        <?php
        $headerlink_color = get_option('littlemonsters_color_headerlink_color');
        if( !empty($headerlink_color) && preg_match("#\##", $headerlink_color) ) : ?>
            .opal-page-inner .site-header a,.navbar-mega .navbar-nav > li > a,.topcart{
                color:<?php echo esc_attr($headerlink_color); ?>;
            }
        <?php endif; ?>

        <?php
        $headerlink_hover_color = get_option('littlemonsters_color_headerlink_hover_color');
        if( !empty($headerlink_hover_color) && preg_match("#\##", $headerlink_hover_color) ) : ?>
            .opal-page-inner .site-header a:hover,.navbar-mega .navbar-nav > li > a:hover, .navbar-mega .navbar-nav > li > a:focus,.navbar-mega .navbar-nav > li.active > a, .navbar-mega .navbar-nav > li:hover > a, .navbar-mega .navbar-nav > li:focus > a,.navbar-mega .navbar-nav > li.active > a .caret, .navbar-mega .navbar-nav > li:hover > a .caret, .navbar-mega .navbar-nav > li:focus > a .caret{
                color:<?php echo esc_attr($headerlink_hover_color); ?>;
            }
        <?php endif; ?>

        <?php
        $breadscrumb_bg = get_option('littlemonsters_color_breadscrumb_bg');
        if( !empty($breadscrumb_bg) && preg_match("#\##", $breadscrumb_bg) ) : ?>
            #opal-breadscrumb{
                background:<?php echo esc_attr($breadscrumb_bg); ?>;
            }
        <?php endif; ?>

        <?php
        $breadscrumb_link_hover = get_option('littlemonsters_color_breadscrumb_link_hover');
        if( !empty($breadscrumb_link_hover) && preg_match("#\##", $breadscrumb_link_hover) ) : ?>
            #opal-breadscrumb .breadcrumb, #opal-breadscrumb .breadcrumb *:last-child, #opal-breadscrumb .breadcrumb *:after{
                color:<?php echo esc_attr($breadscrumb_link_hover); ?>;
            }
        <?php endif; ?>

        <?php
        $breadscrumb_title = get_option('littlemonsters_color_breadscrumb_title');
        if( !empty($breadscrumb_title) && preg_match("#\##", $breadscrumb_title) ) : ?>
            #opal-breadscrumb h2.bread-title{
                color:<?php echo esc_attr($breadscrumb_title); ?>;
            }
        <?php endif; ?>

        <?php
        $footer_bg = get_option('littlemonsters_color_footer_bg');
        if( !empty($footer_bg) && preg_match("#\##", $footer_bg) ) : ?>
            .opal-footer{
                background-color:<?php echo esc_attr($footer_bg); ?>;
            }
        <?php endif; ?>

        <?php
        $footer_color = get_option('littlemonsters_color_footer_color');
        if( !empty($footer_color) && preg_match("#\##", $footer_color) ) : ?>
            .opal-footer, .opal-footer a{
                color:<?php echo esc_attr($footer_color); ?>;
            }
        <?php endif; ?>

        <?php
        $heading_color = get_option('littlemonsters_color_heading_color');
        if( !empty($heading_color) && preg_match("#\##", $heading_color) ) : ?>
            .opal-footer .widget .widget-title, .opal-footer .widget .widgettitle, .opal-footer-profile .kc-title-wrap h3.kc_title, .opal-footer-profile h3{
                color:<?php echo esc_attr($heading_color); ?>;
            }
        <?php endif; ?>

        <?php
        $product_bg = get_option('littlemonsters_color_product_bg');
        if( !empty($product_bg) && preg_match("#\##", $product_bg) ) : ?>
            .product-block:hover .image .product-image:before{
                background-color:<?php echo esc_attr($product_bg); ?>;
            }
        <?php endif; ?>

        <?php
        $product_name = get_option('littlemonsters_color_product_name');
        if( !empty($product_name) && preg_match("#\##", $product_name) ) : ?>
            .product-block .name a{
                color:<?php echo esc_attr($product_name); ?>;
            }
        <?php endif; ?>

        <?php
        $price_color = get_option('littlemonsters_color_price_color');
        if( !empty($price_color) && preg_match("#\##", $price_color) ) : ?>
            .product-block .price > *{
                color:<?php echo esc_attr($price_color); ?>;
            }
        <?php endif; ?>

        <?php
        $price_old_color = get_option('littlemonsters_color_price_old_color');
        if( !empty($price_old_color) && preg_match("#\##", $price_old_color) ) : ?>
            .product-block .price del span{
                color:<?php echo esc_attr($price_old_color); ?>;
            }
        <?php endif; ?>

    </style>
    <?php
    /* OpalTool: inject code */
    /* OpalTool: end inject code */
}
endif; // littlemonsters_fnc_header_style


if ( ! function_exists( 'littlemonsters_fnc_admin_header_style' ) ) :
/**
 * Style the header image displayed on the Appearance > Header screen.
 *
 * @see littlemonsters_fnc_custom_header_setup()
 *
 * @since Littlemonsters 1.0
 */
function littlemonsters_fnc_admin_header_style() {  
?>
	<style type="text/css" id="littlemonsters-admin-header-css">
	.appearance_page_custom-header #headimg {
		background-color: #000;
		border: none;
		max-width: 1260px;
		min-height: 48px;
	}
	#headimg h1 {
		font-family: Lato, sans-serif;
		font-size: 18px;
		line-height: 48px;
		margin: 0 0 0 30px;
	}
	.rtl #headimg h1  {
		margin: 0 30px 0 0;
	}
	#headimg h1 a {
		color: #fff;
		text-decoration: none;
	}
	#headimg img {
		vertical-align: middle;
	}

<?php
}
endif; // littlemonsters_fnc_admin_header_style

if ( ! function_exists( 'littlemonsters_fnc_admin_header_image' ) ) :
/**
 * Create the custom header image markup displayed on the Appearance > Header screen.
 *
 * @see littlemonsters_fnc_custom_header_setup()
 *
 * @since Littlemonsters 1.0
 */
function littlemonsters_fnc_admin_header_image() {
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
		<h1 class="displaying-header-text"><a id="name" style="<?php echo esc_attr( sprintf( 'color: #%s;', get_header_textcolor() ) ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>" tabindex="-1"><?php bloginfo( 'name' ); ?></a></h1>
	</div>
<?php
}
endif; // littlemonsters_fnc_admin_header_image