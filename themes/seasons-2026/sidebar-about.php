<?php
/**
 * Created by PhpStorm.
 * User: ivako
 * Date: 5/16/2018
 * Time: 10:23 PM
 */

if ( is_active_sidebar( 'about' )  ) : ?>
    <section id="about" class="sidebar item widget-area" role="complementary">
        <?php dynamic_sidebar( 'about' ); ?>
    </section><!-- .sidebar .widget-area -->
<?php endif; ?>