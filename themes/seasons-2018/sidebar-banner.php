<?php
/**
 * Created by PhpStorm.
 * User: ivako
 * Date: 5/16/2018
 * Time: 10:23 PM
 */

if ( is_active_sidebar( 'banners' )  ) : ?>
    <div id="banner" class="sidebar widget-area" role="complementary">
        <?php dynamic_sidebar( 'banners' ); ?>
    </div><!-- .sidebar .widget-area -->
<?php endif; ?>