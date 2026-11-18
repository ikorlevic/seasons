<?php
/**
 * Created by PhpStorm.
 * User: iva
 * Date: 08.04.16.
 * Time: 21:21
 */

get_header();
?>
<article>
    <?php while(have_posts()){ the_post();?>

        <h2><?php the_title()?></h2>

        <section><?php the_content();?></section>

        <div class="social">
            <div class="g-plusone" data-annotation="none"></div>
        </div>

        <div class="related">
            <?php

            $orig_post = $post;
            global $post;
            $tags = wp_get_post_tags($post->ID);
            if ($tags) {
                $tag_ids = array();
                foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                $args=array(
                    'tag__in' => $tag_ids,
                    'post__not_in' => array($post->ID),
                    'posts_per_page'=>5, // Number of related posts that will be shown.
                    'caller_get_posts'=>1
                );
                $my_query = new wp_query( $args );
                if( $my_query->have_posts() ) {
                    echo '<h3>Related Posts</h3><ul>';
                    while( $my_query->have_posts() ) {
                        $my_query->the_post(); ?>
                        <li><div class="thumb"><a href="<? the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a></div>
                            <div class="content">
                                <h4><a href="<? the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                                <small><?php the_time('M j, Y') ?></small>
                            </div>
                        </li>
                    <? }
                    echo '</ul>';
                }
            }
            ?>
        </div>
    <?php } ?>
</article>
<?php
get_footer();