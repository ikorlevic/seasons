<?php
/**
 * Created by PhpStorm.
 * User: ivako
 * Date: 28.8.2017.
 * Time: 20:45
 */
?>
    <section class="page">
            <?php if(get_the_post_thumbnail()){
                echo get_the_post_thumbnail($post_ID,"post_thumbnail",array("class"=>"img-responsive"));
            }?>
            <header><h2><?php the_title();?></h2></header>


                <?php the_content(); ?>
    </section>
