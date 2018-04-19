<?php 
	$atts  = array_merge( array(
		'per_page'  => 8,
		'columns'	=> 4,
		'type'		=> 'recent_products',
		'category'	=> '',
		'woocategory' => '',
	), $atts); 
	extract( $atts );
	
	if( empty($type) ){
		return ;
	}
	if( $columns == 5 ){
		$columns = 4;
	}

	if ( isset($woocategory) && !empty($woocategory) ){
		$categories = wpopal_themer_autocomplete_options_helper( $woocategory );
		if(is_array( $categories)){
			foreach( $categories as $key => $name):
				$cats[] = $key;
			endforeach;
		}else
			$cats = '';
	}else {
		$cats = '';
	}

	$loop = wpopal_themer_woocommerce_query( $type, $per_page, $cats );
	$scolumn = $columns > 0 ? 12/$columns : 3;
	$classes[] = 'col-md-'.$scolumn.' col-sm-6 col-xs-12 product-col';
	$classes[] = 'product-carousel-item';

?>

<div class="products-collection woocommerce clearfix nomargin">
	<div class="widget-content">
		<div class="content-product">
			<?php while ( $loop->have_posts() ) : $loop->the_post();  ?>
				<div <?php post_class( $classes ); ?>><?php wc_get_template_part( 'content-product', 'inner'); ?></div>
			<?php endwhile; ?>
		</div>
	</div>
</div>	
<?php wp_reset_postdata(); ?>