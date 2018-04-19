<section id="opal-topbar" class="opal-topbar hidden-xs hidden-sm">
    <div class="container">
        <?php if (has_nav_menu( 'topmenu' )): ?>
            <div class="pull-left">
                <nav class="opal-topmenu" role="navigation">
                    <?php
                    $args = array(
                        'theme_location' => 'topmenu',
                        'menu_class' => 'opal-menu-top list-inline',
                        'fallback_cb' => '',
                        'menu_id' => 'main-topmenu'
                    );
                    wp_nav_menu( $args );
                    ?>
                </nav>

            </div>
        <?php endif; ?>
        <div class="topcart hidden-xs hidden-sm pull-right">
            <ul class="header-top-right">
                <li id="search-container" class="search-box-wrapper">

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
                </li>
                <?php if(class_exists('WpopalFrameworkThemer')): ?>
                <li class="box-user">
                    <i class="fa fa-cog"></i>
                    <div class="btn-group dropdown">
                        <ul class="dropdown-menu">
                            <?php do_action( 'opal-account-buttons' ); ?>      
                                                                                    
                        </ul>
                    </div>
                </li>
                <?php endif; ?>
                <li class="header-cart">

                    <?php do_action( "littlemonsters_template_header_right" ); ?>
                </li>

            </ul>
        </div>
        
    </div>
</section>