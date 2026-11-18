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
<?php while(have_posts()){
    the_post();?>
    <div class="row">
        <div class="title-area col">
            <h2><?php the_title()?></h2>
            <div class="post-tagline"><?php the_excerpt();?></div>
        </div>
        <div class="image col">
            <?php the_post_thumbnail();?>
        </div>
    </div>
<article class="single">
        <section><?php the_content();?></section>

        <div class="social">
            <div class="g-plusone" data-annotation="none"></div>
        </div>

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
</article>
    <?php
    if ( comments_open() || get_comments_number() ) {
        comments_template();
    }
    ?>
        <div class="related">

        </div>
        <div class="clear"></div>

<?php  }  ?>
<?php get_footer();