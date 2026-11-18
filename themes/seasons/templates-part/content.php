<?php
/**
 * Created by PhpStorm.
 * User: iva
 * Date: 08.04.16.
 * Time: 19:28
 */
?>
<div class="item">
    <header><h2><a href="<?php the_permalink()?>"><?php the_title();?></a></h2></header>
    <?php if(get_the_post_thumbnail()){
        echo get_the_post_thumbnail($post_ID,"post_thumbnail",array("class"=>"img-responsive"));
    }?>

    <div class="content">
        <?php the_excerpt(); ?>
    </div>
    <footer>
        <a href="<?php the_permalink() ?>" title="<?php echo get_the_title() ?>">Read more...</a>
    </footer>
</div>
<?php
