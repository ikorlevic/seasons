<?php
/**
 * Created by PhpStorm.
 * User: ivako
 * Date: 19.7.2017.
 * Time: 12:38
 */
 if ( is_active_sidebar( 'insta-feed' )  ) : ?>
    <section id="news" class="sidebar item widget-area" role="complementary">
        <?php dynamic_sidebar( 'insta-feed' ); ?>
    </section><!-- .sidebar .widget-area -->
<?php endif; ?>