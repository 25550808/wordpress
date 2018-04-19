<div id="opal-off-canvas" class="opal-off-canvas sidebar-offcanvas hidden-lg hidden-md">
    <div class="opal-off-canvas-body">
        <div class="offcanvas-head">
            <button type="button" class="btn btn-offcanvas btn-toggle-canvas btn-default" data-toggle="offcanvas">
                <i class="fa fa-close"></i>
            </button>
            <span><?php esc_html_e( 'Menu', 'little-monsters' ); ?></span>
        </div>
            <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
                <?php
                    $args = array( 'theme_location' => 'primary',
                        'container_class' => 'navbar-collapse navbar-offcanvas-collapse',
                        'menu_class' => 'nav navbar-nav',
                        'fallback_cb' => '',
                        'menu_id' => 'main-menu-offcanvas',
                        
                    );
                    if (class_exists( "Wpopal_Megamenu_Offcanvas" )) {
                        $args['walker'] = new Wpopal_Megamenu_Offcanvas();
                    }
                    wp_nav_menu( $args );
                ?>
            </nav>
 

    </div>
</div>