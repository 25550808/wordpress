<?php
$link = get_post_meta( get_the_ID(), 'testimonials_link', true );
$job = get_post_meta( get_the_ID(), 'testimonials_job', true );
?>
<div class="testimonials-left">
    <div class="testimonials-body">
        <div class="testimonials-quote"><?php the_content() ?></div>
        <div class="testimonials-profile">
            <div class="testimonials-avatar radius-x">
                <?php the_post_thumbnail( 'widget', '', 'class="radius-x"' ); ?>
            </div>
            <h4 class="name"><?php the_title(); ?></h4>
            <div class="job">
                <a href="<?php echo empty( $link ) ? '#' : esc_url( $link ); ?>">
                    <?php echo empty( $job ) ? '' : trim( $job ); ?>
                </a>
            </div>
        </div>
    </div>
</div>