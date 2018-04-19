<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package WpOpal
 * @subpackage littlemonsters
 * @since littlemonsters 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-preview">
        <?php littlemonsters_fnc_post_thumbnail(); ?>    
    </div>
    <div class="post-inner">
        <div class="entry-meta">
            <?php
            if ('post' == get_post_type()) {
                littlemonsters_fnc_posted_on();
            }
            ?>
            <?php
            if (!post_password_required() && ( comments_open() || get_comments_number() )) :
                ?>
                <span class="comments-link"><?php comments_popup_link( esc_html__( '  0 Comment', 'little-monsters' ), esc_html__( '  1 Comment', 'little-monsters' ), esc_html__( '  % Comments', 'little-monsters' ) ); ?></span>
                <?php
            endif;/*

                    edit_post_link( esc_html__( 'Edit', 'little-monsters' ), '<span class="edit-link">', '</span>' );*/
            ?>
        </div><!-- .entry-meta -->
        <div class="entry-group">
            <header class="entry-header">

                <?php
                the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                ?>
            </header><!-- .entry-header -->

            <?php if (has_excerpt()) : ?>
                <p><?php echo substr( get_the_excerpt(), 0, 180 ); ?></p>
            <?php endif; ?>
            <div class="readmore">
                <a class="btn-link" href="<?php the_permalink(); ?>" title="<?php esc_html_e( 'Read more', 'little-monsters' ); ?>"><?php esc_html_e( 'Read more', 'little-monsters' ); ?> <i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div><!-- .entry-group -->
        
    </div>
</article><!-- #post-## -->

