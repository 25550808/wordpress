<?php 
$number_post = 10;
$category = '';
$_rows = 4;
extract( $atts );
$_count = 0;
$_id = time().rand();
$_total = $_rows*$columns;
if( isset($woocategory) && !empty($woocategory) ){
	$category = array_keys( wpopal_themer_autocomplete_options_helper($woocategory) );
} 
$loop = wpopal_themer_woocommerce_query( $type, $number_post , $category  );
?>
<div class="widget products-carousel woocommerce clearfix <?php echo esc_attr($layout); ?> ">
	<div class="widgettitle">
		<?php echo littlemonsters_fnc_get_title_type_product($type); ?>
	</div>
	<div class="products-collection owl-carousel-play woocommerce" id="postcarousel-<?php echo esc_attr($_id); ?>" data-ride="carousel">
		<?php   if( $loop->post_count > $_total ) { ?>
		<div class="carousel-controls">
			<a href="#postcarousel-<?php echo esc_attr($_id); ?>" data-slide="prev" class="left carousel-control">
				<i aria-hidden="true" class="fa fa-angle-left"></i>
			</a>
			<a href="#postcarousel-<?php echo esc_attr($_id); ?>" data-slide="next" class="right carousel-control">
				<i aria-hidden="true" class="fa fa-angle-right"></i>
			</a>
		</div>
		<?php } ?>
		<div class="owl-carousel" data-slide="<?php echo esc_attr($columns); ?>" data-jumpto="1" data-singleItem="true" data-navigation="false" data-pagination="false">
		<?php while ( $loop->have_posts() ) : $loop->the_post();  ?>
				<?php if($_count%$_rows == 0): ?>
					<div class="item">
				<?php endif; ?>
				<div <?php post_class( 'product-carousel-item' ); ?>><?php wc_get_template_part( 'content', 'product-'.$layout ); ?></div>
				<?php if($_count%$_rows == $_rows-1 || $_count == $loop->post_count-1): ?>
					</div>
				<?php endif; ?>
				<?php $_count++; ?>
		<?php endwhile; ?>
		</div>
	</div>	
</div>
<?php wp_reset_postdata(); ?>