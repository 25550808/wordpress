<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ): ?>
	<div id="opal-logo" class="logo">
		<?php the_custom_logo(); ?>
	</div>
<?php else: ?>
<?php 
	if(isset($_GET['opal-skin']) && $_GET['opal-skin']) {
		$currentSkin = $_GET['opal-skin'];
	}else{
		$currentSkin = str_replace( '.css','', littlemonsters_fnc_theme_options('skin','default') );
	}
?>
    <div id="opal-logo" class="logo logo-theme">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
             <img src="<?php echo get_template_directory_uri() . '/images/logo-'.$currentSkin.'.png'; ?>" alt="<?php bloginfo( 'name' ); ?>" />
        </a>
    </div>
<?php endif; ?>