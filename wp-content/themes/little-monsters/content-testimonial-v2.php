<?php
$link = get_post_meta( get_the_ID(), 'testimonials_link', true );
$job = get_post_meta( get_the_ID(), 'testimonials_job', true );
?>
<div class="testimonials-v2">
    <div class="testimonials-body">
        <div class="testimonials-avatar radius-x">
            <a href="<?php echo get_post_meta( get_the_ID(), 'testimonials_link', true ); ?>"><?php the_post_thumbnail( 'widget', '', 'class="radius-x"' ); ?></a>
        </div>
        <div class="testimonials-meta">
            <h5 class="testimonials-name"><?php the_title(); ?></h5>
            <div class="job">
                <a href="<?php echo empty( $link ) ? '#' : esc_url( $link ); ?>">
                    <?php echo empty( $job ) ? '' : trim( $job ); ?>
                </a>
            </div>
        </div>
        <div class="testimonials-description"><?php the_content() ?></div>
    </div>
</div>