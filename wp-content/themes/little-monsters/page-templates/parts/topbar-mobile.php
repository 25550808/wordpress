<div class="topbar-mobile  hidden-lg hidden-md">
    <div class="active-mobile active-offcanvas pull-left">
        <button data-toggle="offcanvas" class="btn btn-offcanvas btn-toggle-canvas offcanvas" type="button">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="topbar-inner pull-right">
        <div class="active-mobile search-popup pull-left">
            <span class="fa fa-search"></span>
            <div class="active-content">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="active-mobile setting-popup pull-left">
            <span class="fa fa-user"></span>
            <ul class="active-content">
                <?php do_action( 'opal-account-buttons' ); ?>
            </ul>
        </div>
        <?php if (class_exists( 'WooCommerce' )): ?>
            <div class="active-mobile pull-left cart-popup">
                <span class="fa fa-shopping-basket"></span>
                <div class="active-content">
                    <div class="widget_shopping_cart_content"></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
