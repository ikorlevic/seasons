<?php
/**
 * Created by PhpStorm.
 * User: iva
 * Date: 08.04.16.
 * Time: 19:28
 */
?>
<section class="item" onclick="window.location='<?php the_permalink() ?>'">
    <div class="date-stamp">
        <?php the_date('d')?>
        <span class="month"><?php echo get_the_date('M')?></span>
    </div>
    <div class="inner">
        <div class="featured">
    <?php if(get_the_post_thumbnail()){
        echo get_the_post_thumbnail($post_ID,"post_thumbnail",array("class"=>"img-responsive"));
    }?>
        </div>
    <header><h2><a href="<?php the_permalink()?>"><?php the_title();?></a></h2></header>
        <div class="content">
            <?php the_excerpt(); ?>
        </div>
    </div>
</section>
<?php
