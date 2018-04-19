<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package WpOpal
 * @subpackage Littlemonsters
 * @since Littlemonsters 1.0
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if ( !is_single() ): ?>
        <div class="post-list clearfix">
            <div class="post-preview">
                <?php littlemonsters_fnc_post_thumbnail(); ?>
            </div>
            <div class="entry-group">
                <?php endif; ?>
                <header class="entry-header text-center">
                    <div class="entry-meta">
                        <?php
                        if ('post' == get_post_type()) {
                            littlemonsters_fnc_posted_on();
                        }
                        ?>
                        <span class="post-format">
                            <a class="entry-format"
                               href="<?php echo esc_url( get_post_format_link( 'quote' ) ); ?>"><?php echo get_post_format_string( 'quote' ); ?></a>
                        </span>
                        <span class="entry-category">
                           <?php the_category( ' , ' ); ?>
                        </span>
                        <?php
                        if (!post_password_required() && ( comments_open() || get_comments_number() )) :
                            ?>
                            <span class="comments-link"><?php comments_popup_link( esc_html__( '  0 Comment', 'little-monsters' ), esc_html__( '  1 Comment', 'little-monsters' ), esc_html__( '  % Comments', 'little-monsters' ) ); ?></span>
                            <?php
                        endif;

                        edit_post_link( esc_html__( 'Edit', 'little-monsters' ), '<span class="edit-link">', '</span>' );
                        ?>
                    </div><!-- .entry-meta -->
                    <?php
                    if (is_single()) :
                        the_title( '<h1 class="entry-title">', '</h1>' );
                    else :
                        the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                    endif;
                    ?>

                    
                </header><!-- .entry-header -->
                <?php if (is_single()): ?>
                    <?php littlemonsters_fnc_post_thumbnail(); ?>
                <?php endif; ?>
                

                <div class="entry-content">
                    <?php
                    /* translators: %s: Name of current post */
                    if (is_single()) {
                        the_content( sprintf(
                            esc_html__( 'Continue reading %s', 'little-monsters' ) . '<span class="meta-nav">&rarr;</span>',
                            the_title( '<span class="screen-reader-text">', '</span>', false )
                        ) );
                    } else {
                        the_excerpt();
                    }

                    wp_link_pages( array(
                        'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'little-monsters' ) . '</span>',
                        'after' => '</div>',
                        'link_before' => '<span>',
                        'link_after' => '</span>',
                    ) );
                    ?>
                </div><!-- .entry-content -->
                <?php if (!is_single()): ?>
                    <div class="readmore">
                        <a class="read-link" href="<?php the_permalink(); ?>"
                           title="<?php esc_html_e( 'Read More', 'little-monsters' ); ?>"><?php esc_html_e( 'Read More', 'little-monsters' ); ?>
                            <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                <?php endif; ?>
                <?php if ( !is_single() ): ?>
            </div><!-- #post-## -->

        </div>
    <?php endif; ?>
    </article><!-- #post-## -->
<?php if (is_single()): ?>
    <div class="clearfix"></div>
    <?php the_tags( '<div class="tag-links pull-left">', '', '</div>' ); ?>
<?php endif; ?>