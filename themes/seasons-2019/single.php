<?php
/**
 * Created by PhpStorm.
 * User: iva
 * Date: 08.04.16.
 * Time: 21:21
 */

ini_set('display_errors',1);
get_header();
?>
<article class="single">
    <?php while(have_posts()){
        the_post();?>

        <h2><?php the_title()?></h2>

        <section><?php the_content();?></section>

        <div class="social">
            <div class="g-plusone" data-annotation="none"></div>
        </div>
<?php
        if ( comments_open() || get_comments_number() ) {
        comments_template();
        }
?>
        <div class="gallery">
            <?php
        if( have_rows('gallery') ): ?>
        <ul>
        <?php
            while(have_rows('gallery')):
                the_row();
                ?>
            <li>
                <?php $post = get_sub_field('post');
                $image = get_sub_field('thumbnail'); ?>
                <?php if(!empty($post)): ?>
                    <a href="<?php echo $post['url'] ?>" target="<?php echo $post['target']?>">
                <img src="<?php echo $image['url'] ?>" alt="<?php echo $image["alt"]?>" /><?php echo $post['title']?></a>
                <?php else: ?>
                    <img src="<?php echo $image['url'] ?>"  alt="<?php echo $image["alt"]?>" /><p><?php echo $image["alt"]?></p>
                <?php endif; ?>
            </li>
            <?php
            endwhile;
            ?></ul>
            <?php
            endif;
            ?>
        </div>
        <div class="related">
            <?php

            $orig_post = $post;
            global $post;
            $tags = wp_get_post_tags($post->ID);


            if (!empty($tags)) {
                $tag_ids = array();
                foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                $args=array(
                    'tag__in' => $tag_ids,
                    'post__not_in' => array($post->ID),
                    'posts_per_page'=>5, // Number of related posts that will be shown.
                    'caller_get_posts'=>1
                );
                $my_query = new WP_query( $args );

              //  print_r($my_query->have_posts());

                if( $my_query->have_posts() ) {
                    echo '<h3>Related Posts</h3><ul>';

                        while($my_query->have_posts()):
                         $my_query->the_post(); ?>
                        <li><div class="thumb"><a href="<?php  the_permalink()?>" rel="bookmark" title="<?php  the_title(); ?>"><?php  the_post_thumbnail(); ?></a></div>
                            <div class="content">
                                <h4><a href="<?php the_permalink()?>" rel="bookmark" title="<?php  the_title(); ?>"><?php  the_title(); ?></a></h4>
                                <small><?php  the_time('M j, Y') ?></small>
                            </div>
                        </li>
                    <?php
                        endwhile;
                    echo '</ul>';
                }
            }

            $post = $orig_post;
            ?>
        </div>
        <div class="clear"></div>
    <?php  }  ?>
</article>
<?php get_footer();