<?php
//////// Template HOOKS ////////////////////
/**
 * Remove javascript and css files not use
 */
if (is_admin()) {
    function littlemonsters_setup_admin_setting() {

        global $pagenow;
        if (is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php') {
            /**
             *
             */
            $pts = array( 'brands', 'footer', 'megamenu', 'gallery', 'testimonials', 'team', 'portfolio','video' );

            $options = array();

            foreach ($pts as $key) {
                $options['enable_' . $key] = 'on';
            }

            update_option( 'wpopal_themer_posttype', $options );

            do_action( 'littlemonsters_setup_theme_actived' );
        }
    }

    add_action( 'init', 'littlemonsters_setup_admin_setting' );
}


/**
 * Remove supported posttypes which provided by framework
 */
function littlemonsters_fnc_load_posttype_files($output) {
    $pts = array( 'brands', 'testimonials', 'portfolio', 'footer', 'megamenu', 'team', 'gallery','video' );

    foreach ($output as $key => $file) {
        if (!( in_array( $key, $pts ) )) {
            unset( $output[$key] );
        }
    }

    return $output;
}

add_filter( 'wpopal_themer_load_posttype_files', 'littlemonsters_fnc_load_posttype_files', 1, 10 );


/**
 * Hoo to top bar layout
 */
function littlemonsters_fnc_topbar_layout() {
    $layout = littlemonsters_fnc_get_header_layout();
    get_template_part( 'page-templates/parts/topbar', $layout );
    get_template_part( 'page-templates/parts/topbar', 'mobile' );
}

add_action( 'littlemonsters_template_header_before', 'littlemonsters_fnc_topbar_layout' );

/**
 * Hook to select header layout for archive layout
 */
function littlemonsters_fnc_get_header_layout($layout = '') {
    global $post;

    if(is_object( $post) && isset($post->ID)){
        $layout = $post && get_post_meta( $post->ID, 'littlemonsters_header_layout', 1 ) ? get_post_meta( $post->ID, 'littlemonsters_header_layout', 1 ) : littlemonsters_fnc_theme_options( 'headerlayout' );
    }else{
        $layout = littlemonsters_fnc_theme_options( 'headerlayout' );
    }

    if ($layout && $layout !='default') {
        return trim( $layout );
    } else{
        return '';
    }
}

add_filter( 'littlemonsters_fnc_get_header_layout', 'littlemonsters_fnc_get_header_layout' );

/**
 * Hook to select header layout for archive layout
 */
function littlemonsters_fnc_get_footer_profile($profile = 'default') {
    global $post;
    $profile = $post ? get_post_meta( $post->ID, 'littlemonsters_footer_profile', 1 ) : null;

    if ($profile && $profile != 'global') {
        return trim( $profile );
    } elseif ($profile = littlemonsters_fnc_theme_options( 'footer-style', $profile )) {
        return trim( $profile );
    }

    return $profile;
}

add_filter( 'littlemonsters_fnc_get_footer_profile', 'littlemonsters_fnc_get_footer_profile' );


/**
 * Hook to show breadscrumbs
 */
function littlemonsters_fnc_render_breadcrumbs() {
    global $post;
    if(is_object( $post) && isset( $post->ID)){
        $disable = get_post_meta( $post->ID, 'littlemonsters_disable_breadscrumb', 1 );
        if ($disable || is_front_page()) {
            return true;
        }
    }
    
    $layout = isset( $_GET['breadcrumb'] ) ? $_GET['breadcrumb'] : littlemonsters_fnc_theme_options( 'breadcrumb_layout', 'no-title' );
    $bg_breadcrumb = littlemonsters_fnc_theme_options( 'breadcrumb-bg', false );
    $style = '';
    if ($bg_breadcrumb) {
        $style = ' style="background-image: url(' . $bg_breadcrumb . ')"';
    }
    if (!is_home() && !is_front_page() || is_paged()) {
        echo '<section id="opal-breadscrumb" class="opal-breadscrumb breads-' . esc_attr( $layout ) . '"' . $style . '><div class="container">';
        littlemonsters_fnc_breadcrumbs();
        echo '</div></section>';
    }

}

add_action( 'littlemonsters_template_main_before', 'littlemonsters_fnc_render_breadcrumbs' );


/**
 * Main Container
 */

function littlemonsters_template_main_container_class($class) {
    global $post;
    global $littlemonsters_wpopconfig;

    if (is_object( $post ) && !empty( $post )) {
        $layoutcls = get_post_meta( $post->ID, 'littlemonsters_enable_fullwidth_layout', 1 );

        if ($layoutcls) {
            $littlemonsters_wpopconfig['layout'] = 'fullwidth';
            return 'container-fluid';
        }
    }
    return $class;
}

add_filter( 'littlemonsters_template_main_container_class', 'littlemonsters_template_main_container_class', 1, 1 );
add_filter( 'littlemonsters_template_main_content_class', 'littlemonsters_template_main_container_class', 1, 1 );


/**
 * Get Configuration for Page Layout
 *
 */
function littlemonsters_fnc_get_page_sidebar_configs($configs = '') {

    global $post;

    $layout = get_post_meta( $post->ID, 'littlemonsters_page_layout', 1 );
    $left = get_post_meta( $post->ID, 'littlemonsters_leftsidebar', 1 );
    $right = get_post_meta( $post->ID, 'littlemonsters_rightsidebar', 1 );

    return littlemonsters_fnc_get_layout_configs( $left, $right, $layout );
}

add_filter( 'littlemonsters_fnc_get_page_sidebar_configs', 'littlemonsters_fnc_get_page_sidebar_configs', 1, 1 );


function littlemonsters_fnc_get_single_sidebar_configs($configs = '') {

    $layout = littlemonsters_fnc_theme_options( 'blog-single-layout' );
    $left = littlemonsters_fnc_theme_options( 'blog-single-left-sidebar' );
    $right = littlemonsters_fnc_theme_options( 'blog-single-right-sidebar' );

    return littlemonsters_fnc_get_layout_configs( $left, $right, $layout );
}

add_filter( 'littlemonsters_fnc_get_single_sidebar_configs', 'littlemonsters_fnc_get_single_sidebar_configs', 1, 1 );

function littlemonsters_fnc_get_archive_sidebar_configs($configs = '') {

    $layout = littlemonsters_fnc_theme_options( 'blog-archive-layout' );
    $left = littlemonsters_fnc_theme_options( 'blog-archive-left-sidebar' );
    $right = littlemonsters_fnc_theme_options( 'blog-archive-right-sidebar' );

    return littlemonsters_fnc_get_layout_configs( $left, $right, $layout );
}

add_filter( 'littlemonsters_fnc_get_archive_sidebar_configs', 'littlemonsters_fnc_get_archive_sidebar_configs', 1, 1 );
add_filter( 'littlemonsters_fnc_get_category_sidebar_configs', 'littlemonsters_fnc_get_archive_sidebar_configs', 1, 1 );

/**
 *
 */
function littlemonsters_fnc_get_layout_configs($left, $right, $layout = null) {
    $configs = array();
    $configs['main'] = array( 'class' => 'col-lg-9 col-md-9' );

    $left = isset( $_GET['sidebar_left'] ) ? $_GET['sidebar_left'] : $left;
    $left = is_active_sidebar( $left ) ? $left : "";
    $right = isset( $_GET['sidebar_right'] ) ? $_GET['sidebar_right'] : $right;
    $right = is_active_sidebar( $right ) ? $right : "";
    $layout = isset( $_GET['sidebar_main'] ) ? $_GET['sidebar_main'] : $layout;

    if ($layout && $layout == 'leftmain') {
        $configs['sidebars'] = array(
            'left' => array( 'sidebar' => $left, 'active' => 1, 'class' => 'col-lg-3 col-md-3' ),
            'right' => array( 'sidebar' => $right, 'active' => 0, 'class' => '' )
        );
    } elseif ($layout && $layout == 'mainright') {
        $configs['sidebars'] = array(
            'left' => array( 'sidebar' => $left, 'active' => 0, 'class' => '' ),
            'right' => array( 'sidebar' => $right, 'active' => 1, 'class' => 'col-lg-3 col-md-3' )
        );
    } elseif ($layout && $layout == 'leftmainright') {
        $configs['sidebars'] = array(
            'left' => array( 'sidebar' => $left, 'active' => 1, 'class' => 'col-lg-3 col-md-3' ),
            'right' => array( 'sidebar' => $right, 'active' => 1, 'class' => 'col-lg-3 col-md-3' )
        );
        $configs['main'] = array( 'class' => 'col-lg-6 col-md-6' );

    } else {
        $configs['sidebars'] = array(
            'left' => array( 'sidebar' => $left, 'active' => 0, 'class' => '' ),
            'right' => array( 'sidebar' => $right, 'active' => 0, 'class' => '' )
        );
        $configs['main'] = array( 'class' => 'col-lg-12 col-md-12' );
    }
    return $configs;
}


function littlemonsters_fnc_sidebars_others_configs() {

    global $littlemonsters_page_layouts;
    return $littlemonsters_page_layouts;
}

add_filter( "littlemonsters_fnc_sidebars_others_configs", "littlemonsters_fnc_sidebars_others_configs" );


/**
 * Footer builder profile is custom post type, its content is shortcode rendering with visual composer
 *
 * @param $footer
 *
 */

function littlemonsters_fnc_get_footer_profile_postdata($footer) {

    if (is_numeric( $footer )) {
        $post = get_post( $footer );
    } else {
        $post = get_posts( array(
            'name' => $footer,
            'numberposts' => 1,
            'post_type' => 'footer' ) );
        $post = count( $post ) && $post ? $post[0] : null;
    }
    wp_reset_postdata();
    return $post;
}

function littlemonsters_fnc_render_post_content($post) {

    global $littlemonsters_wpopconfig;

    $littlemonsters_wpopconfig['type'] = 'footer';
    if ($post) {
        echo do_shortcode( $post->post_content );
    }

    $littlemonsters_wpopconfig['type'] = '';
}


/**
 * create a random key to use as primary key.
 */
if (!function_exists( 'littlemonsters_fnc_makeid' )) {
    function littlemonsters_fnc_makeid($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand( 0, strlen( $characters ) - 1 )];
        }
        return $randomString;
    }
}


if (!function_exists( 'littlemonsters_fnc_excerpt' )) {
    //Custom Excerpt Function
    function littlemonsters_fnc_excerpt($limit, $afterlimit = '[...]') {
        $excerpt = get_the_excerpt();
        if ($excerpt != '') {
            $excerpt = explode( ' ', strip_tags( $excerpt ), $limit );
        } else {
            $excerpt = explode( ' ', strip_tags( get_the_content() ), $limit );
        }
        if (count( $excerpt ) >= $limit) {
            array_pop( $excerpt );
            $excerpt = implode( " ", $excerpt ) . ' ' . $afterlimit;
        } else {
            $excerpt = implode( " ", $excerpt );
        }
        $excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );
        return strip_shortcodes( $excerpt );
    }
}


function littlemonsters_fnc_get_widget_block_styles() {
    return array( 'default', 'primary', 'danger', 'success', 'warning', 'coffe', 'bluesky' );
}

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Littlemonsters 1.0
 *
 * @param array $classes A list of existing body class values.
 *
 * @return array The filtered body class list.
 */
function littlemonsters_fnc_body_classes($classes) {
    global $post;

    $additionclass = ( is_object( $post ) ? get_post_meta( $post->ID, 'littlemonsters_additionclass', 1 ) : '' );
    if (!empty( $additionclass )) {
        $classes[] = $additionclass;
    }

    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    if (get_header_image()) {
        $classes[] = 'header-image';
    } elseif (!in_array( $GLOBALS['pagenow'], array( 'wp-activate.php', 'wp-signup.php' ) )) {
        $classes[] = 'masthead-fixed';
    }


    if (is_singular() && !is_front_page()) {
        $classes[] = 'singular';
    }

    $currentSkin = str_replace( '.css', '', littlemonsters_fnc_theme_options( 'skin', 'default' ) );

    if ($currentSkin) {
        $class[] = 'skin-' . $currentSkin;
    }

    return $classes;
}

add_filter( 'body_class', 'littlemonsters_fnc_body_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Littlemonsters 1.0
 *
 * @global int   $paged WordPress archive pagination page count.
 * @global int   $page WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 *
 * @return string The filtered title.
 */
function littlemonsters_fnc_wp_title($title, $sep) {
    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo( 'name', 'display' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ($site_description && ( is_home() || is_front_page() )) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if (( $paged >= 2 || $page >= 2 ) && !is_404()) {
        $title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'little-monsters' ), max( $paged, $page ) );
    }

    return $title;
}

add_filter( 'wp_title', 'littlemonsters_fnc_wp_title', 10, 2 );


/**
 * upbootwp_breadcrumbs function.
 * Edit the standart breadcrumbs to fit the bootstrap style without producing more css
 * @access public
 * @return void
 */
function littlemonsters_fnc_breadcrumbs() {
    $delimiter = '/';
    $home = esc_html__( 'Home', 'little-monsters' );
    $before = '<li class="">';
    $after = '</li>';


    $layout = isset( $_GET['breadcrumb'] ) ? $_GET['breadcrumb'] : littlemonsters_fnc_theme_options( 'breadcrumb_layout', 'no-title' );
        littlemonsters_fnc_breadcrumbs_title();
    echo '<ol class="breadcrumb">';

    global $post;
    $homeLink = esc_url( home_url() );
    echo '<li><a href="' . ( $homeLink ) . '">' . $home . '</a> ' . $delimiter . '</li> ';
    global $wp_query;

    if (is_category()) {
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category( $thisCat );
        $parentCat = get_category( $thisCat->parent );
        if ($thisCat->parent != 0) {
            echo( get_category_parents( $parentCat, TRUE, ' ' . $delimiter . ' ' ) );
        }
        echo trim( $before ) . single_cat_title( '', false ) . $after;

    } elseif (is_day()) {
        echo '<li><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . get_the_time( 'Y' ) . '</a></li> ' . $delimiter . ' ';
        echo '<li><a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . get_the_time( 'F' ) . '</a></li> ' . $delimiter . ' ';
        echo trim( $before ) . get_the_time( 'd' ) . $after;

    } elseif (is_month()) {
        echo '<a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . get_the_time( 'Y' ) . '</a></li> ' . $delimiter . ' ';
        echo trim( $before ) . get_the_time( 'F' ) . $after;

    } elseif (is_year()) {
        echo trim( $before ) . get_the_time( 'Y' ) . $after;

    } elseif (is_single() && !is_attachment()) {

        if (isset( $wp_query->query['post_type'] ) && $wp_query->query['post_type'] != 'post') {
            $post_type = get_post_type_object( $wp_query->query['post_type'] );

            if (is_object( $post_type ) && $post_type->rewrite) {
                $slug = $post_type->rewrite;
                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ';
            }
            $_title = esc_html__( 'Detail', 'little-monsters' );
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            echo get_category_parents( $cat, TRUE, ' ' . $delimiter . ' ' );
            echo trim( $before ) . get_the_title() . $after;
            $_title = esc_html__( 'Blog', 'little-monsters' );
        }

    } elseif (is_search()) {
        echo trim( $before ) . esc_html__( 'Search results for "', 'little-monsters' ) . get_search_query() . '"' . $after;
    } elseif (is_attachment()) {
        $parent = get_post( $post->post_parent );
        $cat = get_the_category( $parent->ID );
        $cat = $cat[0];
        echo get_category_parents( $cat, TRUE, ' ' . $delimiter . ' ' );
        echo '<a href="' . esc_url( get_permalink( $parent ) ) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
        echo trim( $before ) . get_the_title() . $after;

    } elseif (is_page() && !$post->post_parent) {
        echo trim( $before ) . get_the_title() . $after;

    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page( $parent_id );
            $breadcrumbs[] = '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . get_the_title( $page->ID ) . '</a></li>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse( $breadcrumbs );
        foreach ($breadcrumbs as $crumb)
            echo trim( $crumb ) . ' ' . $delimiter . ' ';
        echo trim( $before ) . get_the_title() . $after;

    } elseif (is_tag()) {
        echo trim( $before ) . esc_html__( 'Posts tagged "', 'little-monsters' ) . single_tag_title( '', false ) . '"' . $after;

    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata( $author );
        echo trim( $before ) . esc_html__( 'Articles posted by ', 'little-monsters' ) . $userdata->display_name . $after;
        //echo '<h2 class="active">'.esc_html__('Posts Author', 'little-monsters').'</h2>';

    } elseif (is_404()) {
        echo trim( $before ) . esc_html__( 'Error 404', 'little-monsters' ) . $after;
    } elseif (is_tax()) {
        echo trim( $before ) . esc_html__( 'Posts format', 'little-monsters' ) . $after;
        //echo '<h2 class="active">'.get_post_format().'</h2>';
    } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
        if (is_tax( 'give_forms_category' )) {
            echo '<li>' . get_queried_object()->name . '</li>';
        } elseif (is_tax( 'tribe_events_cat' )) {
            echo '<li>' . get_queried_object()->name . '</li>';
        } else {
            $post_type = get_post_type_object( get_post_type() );
            if (is_object( $post_type ) && isset( $post_type->labels->singular_name )) {
                echo trim( $before ) . $post_type->labels->singular_name . $after;
            }
        }

    } else {
        echo trim( $before ) . esc_html__( 'Page detail', 'little-monsters' ) . $after;
    }

    echo '</ol>';
}

function littlemonsters_fnc_breadcrumbs_title() {
    global $post, $wp_query;
    $layout = isset( $_GET['breadcrumb'] ) ? $_GET['breadcrumb'] : littlemonsters_fnc_theme_options( 'breadcrumb_layout', 'no-title' );
    $class = '';
    if (is_category()) {
        echo '<h2 class="bread-title' . $class . '">' . esc_html__( ' Blog List', 'little-monsters' ) . '</h2>';
    } elseif (is_day()) {
        echo '<h2 class="bread-title' . $class . '">' . get_the_time( 'd' ) . '</h2>';
    } elseif (is_month()) {
        echo '<h2 class="bread-title' . $class . '">' . get_the_time( 'F' ) . '</h2>';
    } elseif (is_year()) {
        echo get_the_time( 'Y' );
    }elseif (is_search()) {
        echo '<h2 class="bread-title' . $class . '">' . esc_html__( 'Search results ', 'little-monsters' ) . '</h2>';
    } elseif (is_attachment()) {

    } elseif (is_single() && !is_attachment()) {
        if (isset( $wp_query->query['post_type'] ) && $wp_query->query['post_type'] != 'post') {
            $post_type = get_post_type_object( $wp_query->query['post_type'] );
            echo '<h2 class="bread-title' . $class . '">' . $post_type->labels->singular_name. esc_html__( ' detail', 'little-monsters' ) . '</h2>';
        }else{
            echo '<h2 class="bread-title' . $class . '">' . esc_html__( 'Blog', 'little-monsters' ) . '</h2>';
        }
    }elseif (is_page() && !$post->post_parent) {
        echo '<h2 class="bread-title' . $class . '">' . get_the_title() . '</h2>';
    } elseif (is_page() && $post->post_parent) {
        echo '<h2 class="bread-title' . $class . '">' . get_the_title() . '</h2>';
    } elseif (is_tag()) {
        echo '<h2 class="bread-title' . $class . '">' . esc_html__( 'Posts tagged', 'little-monsters' ) . '</h2>';
    } elseif (is_author()) {

    } elseif (is_404()) {
        echo '<h2 class="bread-title' . $class . '">' . esc_html__( 'Error 404', 'little-monsters' ) . '</h2>';
    } elseif (is_tax()) {

    }  elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
        if (is_tax( 'give_forms_category' )) {
            echo '<h2 class="bread-title' . $class . '">' . esc_html__( 'Give Category', 'little-monsters' ) . '</h2>';
        } elseif (is_tax( 'tribe_events_cat' )) {
            echo '<h2 class="bread-title' . $class . '">' . esc_html__( 'Event Category', 'little-monsters' ) . '</h2>';
        } elseif (is_post_type_archive( 'tribe_events' )) {
            echo '<h2 class="bread-title' . $class . '">' . esc_html__( 'Our Events', 'little-monsters' ) . '</h2>';
        } elseif (is_post_type_archive( 'team' )) {
            echo '<h2 class="bread-title' . $class . '">' . esc_html__( 'Our Team', 'little-monsters' ) . '</h2>';
        } else {
            echo '<h2 class="bread-title' . $class . '">' . get_the_title() . '</h2>';
        }
    }else {
        echo '<h2 class="bread-title' . $class . '">' . esc_html__( 'Page detail', 'little-monsters' ) . '</h2>';
    }
}


function littlemonsters_display_footer_content(){
    $footer_profile =  apply_filters( 'littlemonsters_fnc_get_footer_profile', 'default' );
     
    $footer_data = littlemonsters_fnc_get_footer_profile_postdata( $footer_profile );
    $layout = $footer_data ? get_post_meta( $footer_data->ID, 'wpopal_themer_footerfullwidth', true ) : '';
    if (!$layout) {
        $layout = 'boxed';
    }

    $class = $layout === 'boxed' ? 'container' : 'container-fluid';
    if( $footer_data &&  $footer_data->post_content && $footer_profile ): 
    ?>
    <div class="opal-footer-profile clearfix <?php echo esc_attr( $class ); ?> inner">
        <?php 
            if (function_exists('kc_do_shortcode')){    
                $raw_content = kc_raw_content( $footer_data->ID );
                echo kc_do_shortcode( $raw_content );
            }else{
                // Use default method if KC is deactived
                echo do_shortcode ($footer_data->post_content);
            }
        ?>
    </div>
    <?php else: ?>
    <?php get_sidebar( 'footer' ); ?>
    <?php endif; ?>

<?php
} 

/**
 *
 */
function littlemonsters_display_footer_copyright() {
    $copyright_text = littlemonsters_fnc_theme_options( 'copyright_text', '' );
    if (!empty( $copyright_text )) {
        echo do_shortcode( $copyright_text );
    } else {
        $devby = '<a target="_blank" href="' . esc_url( 'http://wpopal.com' ) . '">Opal Team</a>';
        printf( esc_html__( 'Proudly powered by %s. Developed by %s', 'little-monsters' ), 'WordPress', $devby );
    }
}

/**
 *
 */
if (!function_exists( 'littlemonsters_wpopal_categories_searchform' )) {
    function littlemonsters_fnc_categories_searchform() {
        if (class_exists( 'WooCommerce' )) {
            
            $dropdown_args = array(
                'show_count' => false,
                'hierarchical' => true,
                'show_uncategorized' => 0
            );
            ?>
            <form method="get" class="input-group search-category" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="input-group-addon search-category-container">
                    <div class="select">
                        <?php wc_product_dropdown_categories( $dropdown_args ); ?>
                    </div>
                </div>
                <input name="s" maxlength="60" class="form-control search-category-input" type="text" size="20"
                       placeholder="<?php esc_html_e( 'What do you need...', 'little-monsters' ); ?>">

                <div class="input-group-btn">
                    <label class="btn btn-link btn-search">
                        <span class="title-search hidden"><?php esc_html_e( 'Search', 'little-monsters' ) ?></span>
                        <input type="submit" class="fa searchsubmit" value="&#xf002;"/>
                    </label>
                    <input type="hidden" name="post_type" value="product"/>
                </div>
            </form>
            <?php
        } else {
            get_search_form();
        }
    }
}
add_action( 'littlemonsters_fnc_credits', 'littlemonsters_fnc_image_payment' );
function littlemonsters_fnc_image_payment() {

    if (littlemonsters_fnc_theme_options( 'image-payment', '' )) { ?>
        <div class="payment">
            <img alt="" src="<?php echo esc_url_raw( littlemonsters_fnc_theme_options( 'image-payment', '' ) ); ?>"/>
        </div>
    <?php }
}