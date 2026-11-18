<?php
/**
 * Created by PhpStorm.
 * User: iva
 * Date: 08.04.16.
 * Time: 18:08
 */

get_header()
?>
<article class="category" id="content">
<?php if ( have_posts() ) : ?>

    <?php if ( is_home() && ! is_front_page() ) : ?>
        <header>
            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
        </header>

    <?php endif; ?>

    <h1 class="page-title"><?php echo single_cat_title().' ';_e('posts') ?></h1>
    <?php
    // Start the loop.
$i++;
    while ( have_posts() ) : the_post();

        /*
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        get_template_part( 'templates-part/content', get_post_format() );

        if($i==2){
            ?>
            <section class="item">
                <h3>Add by Google</h3>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-format="fluid"
                     data-ad-layout-key="+3y+qc+2d-5d+bk"
                     data-ad-client="ca-pub-6862177376862828"
                     data-ad-slot="8274214683"></ins>

            </section>
            <?php
        }
        $i ++;

        // End the loop.
    endwhile;

    // Previous/next page navigation.
 /*   the_posts_pagination( array(
        'prev_text'          => __( 'Previous page', 'seasons' ),
        'next_text'          => __( 'Next page', 'seasons' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'seasons' ) . ' </span>',
    ) );
 */
?>

    <?php
// If no content, include the "No posts found" template.
else :
    get_template_part( 'template-parts/content', 'none' );

endif;
?>
    <?php get_sidebar() ?>
</article>

<?php get_footer(); ?>
<script>
    jQuery(document).ready(function(){
        (adsbygoogle = window.adsbygoogle || []).push({});

    });
</script>