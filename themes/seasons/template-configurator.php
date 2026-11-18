<?php
/**
 * Template Name: Garden Configurator
 */


get_header();

?>

<article>
<h2>in development</h2>
<?php if ( have_posts() ) : ?>
    <div class="tools">
<!--        <label>Metric system</label>-->
<!--        <select name="system">-->
<!--            <option value="m" selected>metric</option>-->
<!--           <option value="">metric</option>-->
<!--        </select>-->
        &nbsp;
        <label>Season</label>
        <select id="season" name="season">
            <option value="spring">Spring</option>
            <option value="summer">Summer</option>
            <option value="autumn">Autumn</option>
            <option value="winter">Winter</option>
        </select>
        &nbsp;
        <label>Choose your object</label>
        <input type="radio" name="type" class='type' value="plant">Plant</input>
        <input type="radio" name="type" class='type' value="container">Container</input>
        <input type="radio" name="type" class='type' value="furniture">Furniture</input>
        <input type="radio" name="type" class='type' value="surface">Surface</input>

        <div class="objects">
           <ul id="plant" style="display:none">
            <li class="autumn-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/aster-pink.png"/>Aster Pink</label></li>
            <li class="autumn-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/aster-violet.png"/>Aster Violet</label></li>
            <li class="autumn-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/aster-white.png"/>Aster White</label></li>
            <li class="spring-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/bergenia.png"/>Bergenia</label></li>
            <li class="summer-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/calla.png"/>Calla</label></li>
            <li class="spring-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/daffodil.png"/>Daffodil</label></li>
            <li class="summer-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/damask-pale.png"/>Damask Rose White</label></li>
            <li class="summer-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/damask-pink.png"/>Damask Rose Pink</label></li>
            <li class="summer-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/red-damask.png"/>Damask Rose Red</label></li>
            <li class="all-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/fern.png"/>Fern</label></li>
            <li class="excpt-winter"><label><img src="<?php echo get_template_directory_uri()?>/garden/gerbera.png"/>Gerbera</label></li>
            <li class="summer-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/iris-pink.png"/>Iris Pink</label></li>
            <li class="summer-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/iris-violet.png"/>Iris Violet</label></li>
            <li class="summer-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/iris-yellow.png"/>Iris Yellow</label></li>
            <li class="summer-time autumn-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/lilly.png"/>Lilly</label></li>
            <li class="spring-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/lilly-of-the-valley.png"/>Lilly of the valley</label></li>
            <li class="summer-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/poppy.png"/>Poppy</label></li>
            <li class="spring-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/red-tulip.png"/>Red Tulip</label></li>
            <li class="spring-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/tulip-yellow.png"/>Tulip Yellow</label></li>
            <li class="summer-time"><label><img src="<?php echo get_template_directory_uri()?>/garden/sunflower.png"/>Sunflower</label></li>
           </ul>

        </div>
        <div class="background">
            <ul id="container" style="display:none">
                <li><span class="container btn" id="rect">Rectangle</span></li>
                <li><span class="container btn" id="circle">Circle</span></li>
                <li><span class="container btn" id="rect-water">Rectangle w/ Water</span></li>
                <li><span class="container btn" id="circle-water">Circle w/ Water</span></li>
            </ul>
            <ul id="furniture" style="display:none">

            </ul>

            <ul id="surface" style="display:none">
                <li><span class="surface btn" id = "rect">Rectangle</span></li>
                <li><span class="surface btn" id = "circle">Circle</span></li>
            </ul>
            <ul class="color">
                <li><span class="brown" id="A52A2A">&nbsp;</span></li>
                <li><span class="maroon" id="800000">&nbsp;</span></li>
                <li><span class="green" id="008000">&nbsp;</span></li>
                <li><span class="olive" id="808000">&nbsp;</span></li>
                <li><span class="silver" id="c0c0c0">&nbsp;</span></li>
                <li><span class="grey" id="808080">&nbsp;</span></li>
                <li><span class="black" id="000000">&nbsp;</span></li>
                <li><span class="white" id="ffffff">&nbsp;</span></li>
                <li><span class="orange" id="ffa500">&nbsp;</span></li>
            </ul>
        </div>
        <a href="delete" class="delete btn">Delete</a>
        <a href="move-up" class="move-up btn">Move up</a>
        <a href="move-down" class="move-down btn">Move down</a>
        <a href="export" class="export btn">Export garden</a>
    </div>
    <br />
<canvas id="garden">

</canvas>
    <br />
    <div class="tools">

    </div>
    <div class="desc"><?php the_content(); ?></div>
<?php endif; ?>

</article>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/jquery.js"></script>

<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.2/fabric.min.js"  crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/garden.js"></script>
<?php

get_footer();
?>
