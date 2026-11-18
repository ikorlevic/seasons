<?php
/**
 * Created by PhpStorm.
 * User: iva
 * Date: 08.04.16.
 * Time: 18:08
 */

get_header();

?>
<article class="home">
    <?php if (have_posts()) : ?>
        <?php
        // Start the loop.
        get_template_part('templates-part/season-highlights', get_post_format());


           get_template_part('templates-part/gardencare', get_post_format());

        $i = 0;
        while (have_posts()) : the_post();

            /*
             * Include the Post-Format-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part('templates-part/content', get_post_format());
//             if ($i == 0) {
//                 get_sidebar("banner");
//                 get_sidebar("features");
//
//             }

//             if ($i == 1) {
//                 echo '</article>';
//                 echo '<article class="category home">';
//                 echo '<h2>' . _('In Season') . '</h2>';
//
//             }
//
//             if ($i == 5) {
//                 get_sidebar("about");
//             }
//             if ($i == 9) {
//                 ?>
                <!-- section class="item add">
                    <h3>Ads by Google</h3>
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <ins class="adsbygoogle" style="display:flex;" data-ad-format="fluid" data-ad-layout-key="+3y+qc+2d-5d+bk" data-ad-client="ca-pub-6862177376862828" data-ad-slot="8274214683"></ins>
                </section -->
                <?php
//             }
            $i++;

            // End the loop.
        endwhile;
//         get_sidebar("insta-feed");
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
        get_template_part('template-parts/content', 'none');

    endif;
    ?>

</article>

<?php get_footer(); ?>
<script>
//     jQuery(document).ready(function () {
//         (adsbygoogle = window.adsbygoogle || []).push({});
//
//     });
</script>
