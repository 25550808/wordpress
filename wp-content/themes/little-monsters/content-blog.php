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
    <?php if(has_post_thumbnail()): ?>
    <div class="post-inner">
    <?php endif;?>
        <div class="entry-meta">
            <span class="author">
                <?php esc_html_e('Posted by ', 'little-monsters');?><span><?php the_author(); ?></span>
            </span>
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
                <p class="hidden"><?php echo substr( get_the_excerpt(), 0, 120 ); ?></p>
            <?php endif; ?> 
            
        </div><!-- .entry-group -->
        
        <?php if(has_post_thumbnail()): ?>
    </div>
    <?php endif;?>
</article><!-- #post-## -->

