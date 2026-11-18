<div class="p2hc-post inner">
    <?php if($disable_featured_image == 'false'){ ?>
    <div class="featured">
        <span class="date-stamp"><?php the_time('d'); ?><span class="month"><?php the_time('M'); ?></span></span>
        <a href="<?php the_permalink(); ?>">
          <img src="<?php echo $thumbnail['0']; ?>" alt="<?php the_title(); ?>">
        </a>
        <!-- <span class="categories-label"><?php the_category( $separator=',' ); ?></span> -->
    </div>
    <?php } ?>
    <div class="content">
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php if($disable_excerpt == 'false'){ ?>
        <?php the_excerpt(); ?>
    <?php } ?>
    </div>
</div>