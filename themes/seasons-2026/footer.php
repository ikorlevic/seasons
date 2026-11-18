<?php
/**
 * Seasonal editorial footer. Existing WordPress menu locations remain supported.
 */
$footer_season = function_exists('current_season') ? current_season() : 'spring';
$footer_groups = array(
    array('title' => __('Garden', 'seasons'), 'categories' => array('grow', 'propagate', 'projects', 'seasonal-tasks', 'garden')),
    array('title' => __('Recipe Book', 'seasons'), 'categories' => array('family-recipes', 'from-my-kitchen', 'preserving', 'drinks', 'recipes')),
    array('title' => __('At Home', 'seasons'), 'categories' => array('make', 'decorate', 'celebrate', 'seasonal-living', 'at-home')),
);
?>
<footer class="seasons-editorial-footer seasons-footer-<?php echo esc_attr($footer_season); ?>">
    <div class="seasons-footer-inner">
        <div class="seasons-footer-grid">
            <div class="seasons-footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="seasons-footer-logo"><?php bloginfo('name'); ?></a>
                <p><?php esc_html_e('In the garden and at home, through the seasons.', 'seasons'); ?></p>
            </div>
            <?php foreach ($footer_groups as $group) : ?>
                <nav class="seasons-footer-column" aria-label="<?php echo esc_attr($group['title']); ?>">
                    <h2><?php echo esc_html($group['title']); ?></h2>
                    <ul>
                        <?php foreach ($group['categories'] as $slug) :
                            $category = get_category_by_slug($slug);
                            if (!$category) { continue; }
                        ?>
                            <li><a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo esc_html($category->name); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endforeach; ?>
            <nav class="seasons-footer-column" aria-label="<?php esc_attr_e('Seasons', 'seasons'); ?>">
                <h2><?php esc_html_e('Seasons', 'seasons'); ?></h2>
                <?php if (has_nav_menu('seasons')) {
                    wp_nav_menu(array('theme_location' => 'seasons', 'container' => false, 'fallback_cb' => false, 'depth' => 1));
                } ?>
            </nav>
            <nav class="seasons-footer-column" aria-label="<?php esc_attr_e('Information', 'seasons'); ?>">
                <h2><?php esc_html_e('Information', 'seasons'); ?></h2>
                <?php if (has_nav_menu('footer')) {
                    wp_nav_menu(array('theme_location' => 'footer', 'container' => false, 'fallback_cb' => false, 'depth' => 1));
                } ?>
            </nav>
        </div>
        <?php if (has_nav_menu('footer_mid')) : ?>
            <nav class="seasons-footer-extra" aria-label="<?php esc_attr_e('Additional links', 'seasons'); ?>">
                <?php wp_nav_menu(array('theme_location' => 'footer_mid', 'container' => false, 'fallback_cb' => false)); ?>
            </nav>
        <?php endif; ?>
        <?php if (has_nav_menu('footer_bottom')) : ?>
            <nav class="seasons-footer-extra" aria-label="<?php esc_attr_e('More information', 'seasons'); ?>">
                <?php wp_nav_menu(array('theme_location' => 'footer_bottom', 'container' => false, 'fallback_cb' => false)); ?>
            </nav>
        <?php endif; ?>
        <div class="seasons-footer-bottom">
            <small>&copy; <?php echo esc_html(wp_date('Y')); ?> <?php bloginfo('name'); ?></small>
            <span><?php esc_html_e('In the garden and at home, through the seasons.', 'seasons'); ?></span>
        </div>
    </div>
</footer>
<?php
wp_footer();
?>



<link href="https://fonts.googleapis.com/css?family=Cantarell&display=swap" rel="stylesheet" defer />
<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/src/style.min.css?v=<?php echo date("YmdHis") ?>" />
<style> body article {display:block;}</style>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/jquery.js"></script>
<script type="text/javascript">
    $(".toggle").click(function(e){
        var el = $(this).attr("rel");
        $(el).slideToggle();
    });

    $(".toggle-search").click(function(e){
        e.stopPropagation();
        e.preventDefault();

        var el = $(this).attr("rel");
        if(el == undefined) el = $(this).find("a").attr('rel');
        $('#'+el).slideToggle();
    });
    function isElementInViewport (el) {

        //special bonus for those using jQuery
        if (typeof jQuery === "function" && el instanceof jQuery) {
            el = el[0];
        }

        var rect = el.getBoundingClientRect();

        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /*or $(window).height() */
            rect.right <= (window.innerWidth || document.documentElement.clientWidth) /*or $(window).width() */
        );
    }

    function onVisibilityChange(el, callback) {
        var old_visible;
        return function () {
            var visible = isElementInViewport(el);
            if (visible != old_visible) {
                old_visible = visible;
                if (typeof callback == 'function') {
                    callback();
                }
            }
        }
    }

    var handler = onVisibilityChange($("#banner"), function() {

        $("#banner").addClass("hello");
    });


    var handler2 = onVisibilityChange($("#news"), function() {
        $("#news").addClass("hello");
    });

    //jQuery
    $(window).on('DOMContentLoaded load resize scroll', handler);
    $(window).on('DOMContentLoaded load resize scroll', handler2);
</script>
<!-- Google Analytics -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-84575133-2', 'auto');
    ga('send', 'pageview');
</script>
<!-- End Google Analytics -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-84575133-2"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-84575133-2');
</script>
<!--    <link rel="alternate" href="http://seasons-in-garden.com--><?php //echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH); ?><!--" hreflang="en" />-->

<script src="https://apis.google.com/js/platform.js" async defer>
    {lang: 'en-GB'}
</script>
</body>
</html>