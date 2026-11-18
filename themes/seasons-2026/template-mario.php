<?php
/**
 * Template Name: Mario Template
 *
 * Created by PhpStorm.
 * User: ivako
 * Date: 10/1/2018
 * Time: 11:43 PM
 */

$posts = get_posts(array(
    'post_type'			=> 'post',
    'category' => '4',
    'posts_per_page'	=> -1,
    'meta_key'			=> 'position',
    'orderby'			=> 'meta_value',
    'order'				=> 'DESC'
));



 if ( $posts ) : ?>

    <?php if ( is_home() && ! is_front_page() ) : ?>
        <header>
            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
        </header>
    <?php endif; ?>

    <?php
    // Start the loop.
      foreach( $posts as $post ):

         setup_postdata( $post );

        /*
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        get_template_part( 'templates-part/content', get_post_format() );

        // End the loop.
    endforeach;

    // Previous/next page navigation.
    /* the_posts_pagination( array(
         'prev_text'          => __( 'Previous page', 'seasons' ),
         'next_text'          => __( 'Next page', 'seasons' ),
         'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'seasons' ) . ' </span>',
     ) ); */
    ?>

<?php
// If no content, include the "No posts found" template.
else :
    get_template_part( 'template-parts/content', 'none' );

endif;
?>

<?php wp_reset_postdata(); ?>
