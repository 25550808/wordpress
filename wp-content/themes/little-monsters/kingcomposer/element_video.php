<?php
$atts = array_merge( array(
		'title'         => 'Video',
		'content'       => '',
		'link'          => '#',
		'video_width'   => '800',
		'video_height'  => '800',
		'title_color'   => '',
		'content_color' => '',
		'video_image'         => '',
	), $atts); 
extract( $atts );
$title_style = $content_style = $output = $img = '';

if( !empty($title_color) ){
	$title_style = 'style="color:'.$title_color.'"';
	$output .= '<div '. trim($title_style).' class="title">'.trim( $title ).'</div>';
}
if( !empty($content_color) ){
	$content_style = 'style="color:'.$content_color.'"';
}

if( !empty($content) && $content != '__empty__'){
	$content = apply_filters('kc_column_text', $content );
	$output .= '<div '.trim($content_style).' class="content">'.wpautop( do_shortcode( $content ) ).'</div>';
}

if( !empty($video_image) ){
	$images = wp_get_attachment_image_src( $video_image, 'full' );
	$img = '<img alt="" src="'. esc_attr($images[0]) .'" />';
}
?>
<div class="widget-video <?php echo ($video_image)? 'widget-video-image': ''; ?>">
	<?php echo trim($output); ?>

	<div class="popup-video <?php echo ($video_image)? 'video-image': ''; ?>">
		<a rel="prettyPhoto[video]" href="<?php echo esc_attr($link); ?>?iframe=true&width=<?php echo esc_attr($video_width); ?>&height=<?php echo esc_attr($video_height); ?>" title=""><i class="fa fa-play"></i></a>
		<?php echo trim($img); ?>
	</div>
</div>