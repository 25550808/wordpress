<?php
$link = get_post_meta( get_the_ID(), 'testimonials_link', true );
$job = get_post_meta( get_the_ID(), 'testimonials_job', true );
?>
<div class="testimonials-v3">
    <div class="testimonials-body"> 
        <h5 class="testimonials-name">
            <?php the_title(); ?>
        </h5>
        <div class="job">
            <a href="<?php echo empty( $link ) ? '#' : esc_url( $link ); ?>">
                <?php echo empty( $job ) ? '' : trim( $job ); ?>
            </a>
        </div>
        <p class="testimonials-description"><?php the_content() ?></p>
    </div>
</div>