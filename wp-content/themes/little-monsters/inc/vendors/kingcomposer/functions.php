<?php

/**
 * Load woocommerce styles follow theme skin actived
 *
 * @static
 * @access public
 * @since Wpopal_Themer 1.0
 */

add_action( 'init', 'littlemonsters_element_kingcomposer_map', 99 );
function littlemonsters_element_kingcomposer_map() {
    global $kc;
    $maps = array();

    $kc->remove_map_param( 'element_pricing_table', 'style' );
    $kc->add_map_param(
        'element_pricing_table',
        array(
            'name' => 'show_image',
            'label' => 'Show background',
            'type' => 'checkbox',  // USAGE CHECKBOX TYPE
            'options' => array( 'yes' => 'Yes, Please!' ),
            'description' => 'Do you want to use background image?',
        )
        , 14 );


    $kc->add_map_param(
        'element_pricing_table',
        array(
            "type" => "attach_image",
            "label" => esc_html__( "Image background header ", 'little-monsters' ),
            "name" => "featured_image",
            "value" => '',
            'description' => '',
            'relation' => array(
                'parent' => 'show_image',
                'show_when' => 'yes'
            )
        )
        , 15 );

    //element_posttype_our_team

    $kc->add_map_param(
        'element_posttype_our_team',
        array(
            "type" => "select",
            "label" => esc_html__( "Style", 'little-monsters' ),
            "name" => "style",
            'options' => array(
                'default' => esc_html__( 'Default', 'little-monsters' ),
                'style1' => esc_html__( 'Style1', 'little-monsters' )
            )
        )
        , 11 );
    //element_blog_posts
    $kc->remove_map_param( 'element_blog_posts', 'items' );
    $kc->add_map_param(
        'element_blog_posts',
        array(
            'name' => 'items',
            'label' => esc_html__( 'Items Limit', 'little-monsters' ),
            'type' => 'number_slider',
            'value' => '4',
            'options' => array(
                'min' => 1,
                'max' => 24,
                'unit' => '',
                'show_input' => false
            ),
            "admin_label" => true,
            'description' => esc_html__( 'Specify number of post that you want to show. Enter -1 to get all team', 'little-monsters' ),
        )
        , 0 );

    $kc->add_map_param(
        'element_blog_posts',
        array(
            'name' => 'show_image',
            'label' => 'Show Image',
            'type' => 'checkbox',  // USAGE CHECKBOX TYPE
            'options' => array( 'yes' => 'Yes, Please!' ),
            'description' => 'Do you want to use image?',
        )
        , 14 );

    $maps['element_gallery'] = array(
        'name' => esc_html__( 'Gallery', 'little-monsters' ),
        'icon' => 'sl-paper-plane',
        'class' => '',
        'description' => '',
        'category' => esc_html__( 'Elements', 'little-monsters' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'label' => esc_html__( 'Title', 'little-monsters' ),
                'name' => 'title',
                'value' => '',
                'admin_label' => true
            ),
            array(
                'name' => 'items',
                'label' => esc_html__( 'Items Limit', 'little-monsters' ),
                'type' => 'number_slider',
                'value' => '5',
                'options' => array(
                    'min' => 1,
                    'max' => 16,
                    'unit' => '',
                    'show_input' => false
                ),
                "admin_label" => true,
                'description' => esc_html__( 'Specify number of post that you want to show. Enter -1 to get all team', 'little-monsters' ),
            ),
            array(
                'name' => 'columns',
                'label' => esc_html__( 'Grid Column', 'little-monsters' ),
                'type' => 'number_slider',
                'value' => 4,
                'options' => array(
                    'min' => 1,
                    'max' => 6,
                    'unit' => '',
                    'show_input' => true
                ),
                "admin_label" => true,
                'description' => 'Display number of post'
            ),
            array(
                "type" => "textfield",
                "label" => esc_html__( "Extra class name", 'little-monsters' ),
                "name" => "el_class",
                "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'little-monsters' )
            )
        )
    );
    //heading
    $maps['element_block_heading'] =  array(

            "name"        => esc_html__("Block Heading", 'little-monsters'),
            "class"       => "",
            "description" => esc_html__( 'Display Block Heading', 'little-monsters' ),
            "category"    => esc_html__('Elements', 'little-monsters'),
            "icon"        => 'kc-icon-title',
            "params"      => array(

            array(
                "type"        => "textfield",
                "label"       => esc_html__("Heading", 'little-monsters'),
                "name"        => "heading",
                "value"       => '',
                "admin_label" => true
            ),
            array(
                "type"        => "textfield",
                "label"       => esc_html__("Sub Heading", 'little-monsters'),
                "name"        => "subheading",
                "value"       => '',
                "admin_label" => true
            ),
            array(
                "type" => "select",
                "label" => esc_html__("Style", 'little-monsters'),
                "name" => "style",
                'options'   => array( 
                    'style-v1' => esc_html__('No style', 'little-monsters'), 
                    'style-v2' => esc_html__('Style left', 'little-monsters'),
                    'style-v3' => esc_html__('Style center', 'little-monsters'),
                    'style-v4' => esc_html__('Style center and sub', 'little-monsters'),
                ),
            ),
          )
    );
    // Video
    $maps['element_video'] =  array(
        "name"        => esc_html__("Video popup", 'little-monsters'),
        "class"       => "",
        "description" => 'Show video popup',
        "category"    => esc_html__('Elements', 'little-monsters'),
        "icon"        => 'cpicon sl-paper-plane',
        'is_container' => true,
        "params"      => array(
            array(
                "type"        => "textfield",
                "label"       => esc_html__("Title", 'little-monsters'),
                "name"        => "title",
                "value"       => '',
                "admin_label" => true
            ),
            array(
                'name' => 'title_color',
                'label' => 'Title Color',
                'type' => 'color_picker',
                'description' => 'Color of the text.'
            ),
            array(
                'name' => 'content_color',
                'label' => 'Content Color',
                'type' => 'color_picker',
                'description' => 'Color of the text.'
            ),
            array(
                'name' => 'content',
                'label' => 'Content',
                'type' => 'textarea_html',
                'value' => 'Sample Text',
            ),
            array(
                "type"        => "textfield",
                "label"       => esc_html__("Video Link", 'little-monsters'),
                "name"        => "link",
                "value"       => '',
                "admin_label" => true
            ),
            array(
                "type"        => "textfield",
                "label"       => esc_html__("Video width", 'little-monsters'),
                "name"        => "video_width",
                "value"       => '800',
                "admin_label" => true
            ),
            array(
                "type"        => "textfield",
                "label"       => esc_html__("Video height", 'little-monsters'),
                "name"        => "video_height",
                "value"       => '500',
                "admin_label" => true
            ),
            array(
                'type' => 'attach_image',
                'label' => esc_html__( 'Image', 'little-monsters' ),
                'name' => 'video_image',
            ),

        )
    );

   

    $maps['element_map'] = array(
        'name' => esc_html__( 'Map Style', 'little-monsters' ),
        'title' => 'Dark Map',
        'icon' => 'kc-icon-icon',
        'category' => 'Elements',
        'wrapper_class' => 'clearfix',
        'description' => esc_html__( 'Map Style Dark', 'little-monsters' ),
        'params' => array(
            array(
                'name' => 'code_number',
                'label' => esc_html__( 'The latitude and longitude', 'little-monsters' ),
                'type' => 'text',
                'admin_label' => true,
                'description' => esc_html__( 'The latitude and longitude to center the map. Ex: 41.515449, -96.951482', 'little-monsters' )
            ),

            array(
                'name' => 'width',
                'label' => esc_html__( 'width', 'little-monsters' ),
                'type' => 'text',
                'admin_label' => true,
                'description' => esc_html__( 'Width of map. ex: 1000px, 500px,.. or 100%, 50%...', 'little-monsters' )
            ),
            array(
                'name' => 'height',
                'label' => esc_html__( 'height', 'little-monsters' ),
                'type' => 'text',
                'admin_label' => true,
                'description' => esc_html__( 'height of map. ex: 400px, 500px...', 'little-monsters' )
            ),

            // end params
        )
    );

    $maps = apply_filters( 'littlemonsters_element_kingcomposer_map', $maps );
    $kc->add_map( $maps );
} // end class/ end class

function littlemonsters_fnc_element_woo_kingcomposer(){
    global $kc;
    $maps = array();

 //products special
    $maps['woo_products_special'] =
        array(
            'name' => 'Products Special',
            'description' => esc_html__( 'Display list product category tabs', 'little-monsters' ),
            'icon' => 'sl-paper-plane',
            'category' => 'Woocommerce',

            'params' => array(

                array(
                    'name' => 'type',
                    'label' => 'Product Type',
                    'type' => 'select',
                    'admin_label' => true,
                    'value' => 'recent_products',
                    'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                        'recent_products' => esc_html__( 'Recent products', 'little-monsters' ),
                        'sale_products' => esc_html__( 'On Sale', 'little-monsters' ),
                        'featured_products' => esc_html__( 'Featured products', 'little-monsters' ),
                        'best_selling_products' => esc_html__( 'Best Sellers', 'little-monsters' ),
                        'products' => esc_html__( 'Products', 'little-monsters' ),
                    )
                ),

                array(
                    'type' => 'autocomplete',
                    'label' => esc_html__( 'Select Category', 'little-monsters' ),
                    'name' => 'woocategory',
                    'description' => esc_html__( 'Select Category to display', 'little-monsters' ),
                    'admin_label' => true,
                    'options' => array( 'category_name' => 'product_cat' )

                ),
                array(
                    'name' => 'number',
                    'label' => 'Number products',
                    'type' => 'number_slider',
                    'value' => '8',
                    'options' => array(
                        'min' => 4,
                        'max' => 20,
                        'unit' => '',
                        'show_input' => true
                    ),
                    'description' => 'Select number product to show (use for Product carousel)'
                ),
            )
        );
    //products category tabs
    $maps['woo_products_category_tabs'] =
        array(
            'name' => 'Products Category Tabs',
            'description' => esc_html__('Display list product category tabs', 'little-monsters'),
            'icon' => 'sl-paper-plane',
            'category' => 'Woocommerce',

            'params' => array(

                array(
                    'name' => 'type',
                    'label' => 'Product Type',
                    'type' => 'select',
                    'admin_label' => true,
                    'value' => 'recent_products',
                    'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                        'recent_products'       => esc_html__( 'Recent products', 'little-monsters' ),
                        'sale_products'         => esc_html__( 'On Sale', 'little-monsters' ),
                        'featured_products'     => esc_html__( 'Featured products', 'little-monsters' ),
                        'best_selling_products' => esc_html__( 'Best Sellers', 'little-monsters' ),
                        'products'              => esc_html__( 'Products', 'little-monsters' ),
                    )
                ),
                
                array(
                    'type'           => 'autocomplete',
                    'label'          => esc_html__( 'Select Category', 'little-monsters' ),
                    'name'           => 'woocategory',
                    'description'    => esc_html__( 'Select Category to display', 'little-monsters' ),
                    'admin_label'    => true,
                    'options' => array( 'category_name' => 'product_cat' )

                ),

                array(
                    'name' => 'layout',
                    'label' => 'Product layout',
                    'type' => 'select',
                    'value' => 'carousel',
                    'admin_label' => true,
                    'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                        'carousel'      => esc_html__( 'Products Carousel', 'little-monsters' ),
                        'grid_list'         => esc_html__( 'Products Grid list', 'little-monsters' ),
                    )
                ),

                array(
                    'name' => 'number',
                    'label' => 'Number products',
                    'type' => 'number_slider',
                    'value' => '8',
                        'options' => array(
                            'min' => 4,
                            'max' => 20,
                            'unit' => '',
                            'show_input' => true
                        ),
                    'description' => 'Select number product to show (use for Product carousel)'
                ),

                array(
                    'name' => 'columns',
                    'label' => 'Columns',
                    'type' => 'number_slider',
                    'value' => '4',
                        'options' => array(
                            'min' => 1,
                            'max' => 6,
                            'unit' => '',
                            'show_input' => true
                        ),
                    'description' => 'Display number column of post (use for Product carousel)'
                ),
            )
    );

         //products carousel
    $kc->add_map_param(
    'woo_carousel_products',                
        array(
            'name' => 'layout',
            'label' => 'Product layout',
            'type' => 'select',
            'admin_label' => true,
            'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                'list_grid'     => esc_html__( 'Products List', 'little-monsters' ),
                'inner'         => esc_html__( 'Products Grid', 'little-monsters' ),
            )
        ),
    3);

    $kc->add_map_param(
    'woo_carousel_products',                
        array(
            'name' => '_rows',
            'label' => 'Rows number',
            'type' => 'number_slider',
            'value' => '1',
                'options' => array(
                    'min' => 1,
                    'max' => 4,
                    'unit' => '',
                    'show_input' => true
                ),
            'description' => 'Display number of post'
        ),
    6);

    //products special
    $maps['woo_products_list'] =
        array(
            'name' => 'Products List',
            'description' => esc_html__( 'Display list product category ', 'little-monsters' ),
            'icon' => 'sl-paper-plane',
            'category' => 'Woocommerce',

            'params' => array(

                array(
                    'name' => 'type',
                    'label' => 'Product Type',
                    'type' => 'select',
                    'admin_label' => true,
                    'value' => 'recent_products',
                    'options' => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
                        'recent_products' => esc_html__( 'Recent products', 'little-monsters' ),
                        'sale_products' => esc_html__( 'On Sale', 'little-monsters' ),
                        'featured_products' => esc_html__( 'Featured products', 'little-monsters' ),
                        'best_selling_products' => esc_html__( 'Best Sellers', 'little-monsters' ),
                        'products' => esc_html__( 'Products', 'little-monsters' ),
                    )
                ),

                array(
                    'type' => 'autocomplete',
                    'label' => esc_html__( 'Select Category', 'little-monsters' ),
                    'name' => 'woocategory',
                    'description' => esc_html__( 'Select Category to display', 'little-monsters' ),
                    'admin_label' => true,
                    'options' => array( 'category_name' => 'product_cat' )

                ),
                array(
                    'name' => 'number',
                    'label' => 'Number products',
                    'type' => 'number_slider',
                    'value' => '8',
                    'options' => array(
                        'min' => 4,
                        'max' => 20,
                        'unit' => '',
                        'show_input' => true
                    ),
                    'description' => 'Select number product to show (use for Product carousel)'
                ),
            )
        );


    $maps = apply_filters( 'littlemonsters_fnc_element_woo_kingcomposer', $maps );
    $kc->add_map( $maps );
}
if(class_exists('WooCommerce')){
    add_action( 'init', 'littlemonsters_fnc_element_woo_kingcomposer', 99 );
}