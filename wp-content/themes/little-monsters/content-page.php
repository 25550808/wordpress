<?php
/**
 * The template used for displaying page content
 *
 * @package WpOpal
 * @subpackage Littlemonsters
 * @since Littlemonsters 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content-page">
        <?php
        the_content();
        wp_link_pages( array(
            'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'little-monsters' ) . '</span>',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
        ) );

        edit_post_link( esc_html__( 'Edit', 'little-monsters' ), '<span class="edit-link">', '</span>' );
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->
