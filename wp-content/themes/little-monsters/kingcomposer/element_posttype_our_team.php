<?php

extract( $atts );
$query = wpopal_fnc_team_query( $atts );

$_id = rand();
$_count = $query->post_count;
?>
<?php if ($query->have_posts()) { ?>
    <div class="team-collection <?php echo esc_attr( $style ); ?>">
        <div id="carousel-<?php echo esc_attr( $_id ); ?>" class="owl-carousel-play" data-ride="owlcarousel">

            <div class="owl-carousel " data-slide="<?php echo esc_attr( $columns ); ?>" data-pagination="true"
                 data-navigation="true">
                <?php $_count = 0;
                while ($query->have_posts()):$query->the_post(); ?>
                    <div class="item">

                        <!-- start items -->
                        <?php
                        $data = array( 'google', 'email', 'job', 'phone_number', 'facebook', 'twitter', 'pinterest' );
                        foreach ($data as $item) {
                            $$item = get_post_meta( get_the_ID(), 'team_' . $item, true );
                        }
                        ?>
                        <div class="team-wrapper">

                            <?php if (has_post_thumbnail()): ?>
                                <div class="team-header">
                                    <a class="team-image"
                                       href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail( 'full', '', 'class="radius-x"' ); ?> </a>
                                    <?php if ($style == 'default') : ?>
                                        <div class="bo-social-icons">
                                            <div class="team-info">
                                                <p><i class="fa fa-phone"></i><?php echo esc_attr( $phone_number ); ?>
                                                </p>
                                                <p><i class="fa fa-envelope"></i><?php echo esc_attr( $email ); ?> </p>
                                            </div>
                                            <?php if ($facebook) { ?>
                                                <a class="bo-social-white radius-x"
                                                   href="<?php echo esc_url( $facebook ); ?>"> <i
                                                            class="fa fa-facebook"></i> </a>
                                            <?php } ?>
                                            <?php if ($twitter) { ?>
                                                <a class="bo-social-white radius-x"
                                                   href="<?php echo esc_url( $twitter ); ?>"><i
                                                            class="fa fa-twitter"></i> </a>
                                            <?php } ?>
                                            <?php if ($pinterest) { ?>
                                                <a class="bo-social-white radius-x"
                                                   href="<?php echo esc_url( $pinterest ); ?>"><i
                                                            class="fa fa-pinterest"></i> </a>
                                            <?php } ?>
                                            <?php if ($google) { ?>
                                                <a class="bo-social-white radius-x"
                                                   href="<?php echo esc_url( $google ); ?>"> <i
                                                            class="fa fa-google"></i></a>
                                            <?php } ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="team-body">
                                <div class="team-body-content">
                                    <h3 class="team-name"><a
                                                href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="team-job"><?php echo esc_html( $job ); ?></div>
                                    <?php if ($style != 'default') : ?>
                                        <div class="team-info">
                                            <span><i class="fa fa-phone"></i><?php echo esc_attr( $phone_number ); ?> </span>
                                            <span><i class="fa fa-envelope"></i><?php echo esc_attr( $email ); ?> </span>
                                        </div>
                                        <div class="bo-social-icons">
                                            <?php if ($facebook) { ?>
                                                <a class="bo-social-white radius-x"
                                                   href="<?php echo esc_url( $facebook ); ?>"> <i
                                                            class="fa fa-facebook"></i> </a>
                                            <?php } ?>
                                            <?php if ($twitter) { ?>
                                                <a class="bo-social-white radius-x"
                                                   href="<?php echo esc_url( $twitter ); ?>"><i
                                                            class="fa fa-twitter"></i> </a>
                                            <?php } ?>
                                            <?php if ($pinterest) { ?>
                                                <a class="bo-social-white radius-x"
                                                   href="<?php echo esc_url( $pinterest ); ?>"><i
                                                            class="fa fa-pinterest"></i> </a>
                                            <?php } ?>
                                            <?php if ($google) { ?>
                                                <a class="bo-social-white radius-x"
                                                   href="<?php echo esc_url( $google ); ?>"> <i
                                                            class="fa fa-google"></i></a>
                                            <?php } ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                        <!-- end items -->


                    </div>
                    <?php $_count++; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php wp_reset_postdata(); ?>