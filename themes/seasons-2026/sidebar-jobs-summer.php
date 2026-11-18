<?php
/**
 * Created by PhpStorm.
 * User: ivako
 * Date: 5/16/2018
 * Time: 10:23 PM
 */

if ( is_active_sidebar( 'jobs-summer' )  ) : ?>
    <section id="jobs-summer" class="sidebar item widget-area" role="complementary">
        <?php dynamic_sidebar( 'jobs-summer' ); ?>
    </section><!-- .sidebar .widget-area -->
<?php endif; ?>