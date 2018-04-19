<?php 
	$type = 'recent_products';
	$number_post = 4;

	$category = '';
	extract( $atts );
	$_id = time().rand();
	
	if($layout == 'carousel'){
		$number_post = $number;
	}

	if( isset($woocategory) && !empty($woocategory) ){
		$categories = array_keys( wpopal_themer_autocomplete_options_helper($woocategory) );
	} 
	$loop = wpopal_themer_woocommerce_query( $type, $number_post);
	$_count = 0;
	$rows_count = 3;
    $class_column='col-sm-12 col-md-6';
?>
<div class="widget products-category-tabs">
	<h3 class="widget-title pull-left"><?php echo littlemonsters_fnc_get_title_type_product($type); ?></h3>
	<div class="hidden-xs sub-categories pull-right">
	    <ul role="tablist" class="nav nav-tabs">
	        <li class="active">
	            <a href="#tab-<?php echo esc_attr($_id);?>-allproducts" data-toggle="tab"><?php esc_html_e('All Products', 'little-monsters'); ?></a>
	        </li>
	        <?php if($categories && is_array($categories)): ?>
		        <?php foreach ($categories as $slug) : ?>
		            <?php $category = get_term_by( 'slug', $slug, 'product_cat' ); ?>
		            <li><a href="#tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($slug); ?>" data-toggle="tab"><?php echo trim( $category->name ); ?></a></li>
		        <?php endforeach; ?>
	        <?php endif; ?>
	    </ul>
	</div>
	<div class="clearfix"></div>
	<?php if($layout == 'grid_list'): ?>
		<div class="products-collection woocommerce">
			<div class="tab-content">
				<div id="tab-<?php echo esc_attr($_id);?>-allproducts" class="tab-pane active no-space-row">
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<?php if($_count==0): ?>
							<div class="item row">
								<div class="<?php echo esc_attr($class_column);?> main-product">
									<?php wc_get_template_part( 'content', 'product-inner' ); ?>
								</div>
						<?php else: ?>
							<?php if($_count==1): ?>
								<div class="<?php echo esc_attr($class_column);?> second-product">
									<ul class="list-product">
							<?php endif; ?>

								<?php wc_get_template_part( 'content', 'product-list' ); ?>

							<?php if($_count==3): ?>
									</ul>
								</div>
							<?php endif; ?>

							<?php if($_count==3 || $_count == $loop->post_count-1): ?>
							</div>
							<?php endif;?>
						<?php endif;?>

						<?php $_count++; ?>	
					<?php endwhile; ?>
				</div>
				<?php if($categories && is_array($categories)): ?>
					<?php foreach ($categories as $slug) : ?>
			            <?php $category = get_term_by( 'slug', $slug, 'product_cat' ); $_count = 0; ?>
						<div id="tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($slug); ?>" class="tab-pane no-space-row">
							<?php $_loop = wpopal_themer_woocommerce_query( $type, $number_post, $slug); ?>
							<?php while ( $_loop->have_posts() ) : $_loop->the_post(); ?>
								<?php if($_count==0): ?>
									<div class="item row">
										<div class="<?php echo esc_attr($class_column);?> main-product">
											<?php wc_get_template_part( 'content', 'product-inner' ); ?>
										</div>
								<?php else: ?>
									<?php if($_count==1): ?>
										<div class="<?php echo esc_attr($class_column);?> ">
											<ul class="list-product">
									<?php endif; ?>

										<?php wc_get_template_part( 'content', 'product-list' ); ?>

									<?php if($_count==3): ?>
											</ul>
										</div>
									<?php endif; ?>

									<?php if($_count==3 || $_count == $_loop->post_count-1): ?>
									</div>
									<?php endif;?>
								<?php endif;?>

								<?php $_count++; ?>	
							<?php endwhile; ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	<?php else: ?>
		<div class="products-collection woocommerce">
			<div class="tab-content">
				<div id="tab-<?php echo esc_attr($_id);?>-allproducts" class="tab-pane active no-space-row">
					<div id="carousel-<?php echo esc_attr($_id); ?>-allproducts" class="inner owl-carousel-play" data-ride="owlcarousel">
						<?php if( $loop->post_count > $columns ) {  ?>
			                <div class="carousel-controls">
			                    <a class="left carousel-control" href="#carousel-<?php echo esc_attr($_id); ?>-allproducts" data-slide="prev">
			                        <i aria-hidden="true" class="zmdi zmdi-chevron-left"></i>
			                    </a>
			                    <a class="right carousel-control" href="#carousel-<?php echo esc_attr($_id); ?>-allproducts" data-slide="next">
			                        <i aria-hidden="true" class="zmdi zmdi-chevron-right"></i>
			                    </a>
			                </div>
			            <?php } ?>
						<div class="owl-carousel rows-products" data-slide="<?php echo esc_attr($columns); ?>" data-desktop="[1199, 3]" data-pagination="false" data-navigation="true">
				            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
										<?php wc_get_template_part( 'content', 'product-inner' ); ?>
							<?php endwhile; ?>
						</div> 
					</div>
				</div>

				<?php if($categories && is_array($categories)): ?>
					<?php foreach ($categories as $slug) : ?>
			            <?php $category = get_term_by( 'slug', $slug, 'product_cat' ); $_count = 0; ?>
						<div id="tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($slug); ?>" class="tab-pane no-space-row">
							<div id="carousel-<?php echo esc_attr($_id); ?>-<?php echo esc_attr($slug); ?>" class="inner owl-carousel-play" data-ride="owlcarousel">
								<?php $_loop = wpopal_themer_woocommerce_query( $type, $number_post, $slug); ?>
								<?php if( $_loop->post_count > $columns ) {  ?>
					                <div class="carousel-controls">
					                    <a class="left carousel-control" href="#carousel-<?php echo esc_attr($_id); ?>-<?php echo esc_attr($slug); ?>" data-slide="prev">
					                        <i aria-hidden="true" class="zmdi zmdi-chevron-left"></i>
					                    </a>
					                    <a class="right carousel-control" href="#carousel-<?php echo esc_attr($_id); ?>-<?php echo esc_attr($slug); ?>" data-slide="next">
					                        <i aria-hidden="true" class="zmdi zmdi-chevron-right"></i>
					                    </a>
					                </div>
					            <?php } ?>
					            <div class="owl-carousel rows-products" data-slide="<?php echo esc_attr($columns); ?>" data-pagination="false" data-navigation="true">
									<?php while ( $_loop->have_posts() ) : $_loop->the_post(); ?>
										<?php wc_get_template_part( 'content', 'product-inner' ); ?>
									<?php endwhile; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>