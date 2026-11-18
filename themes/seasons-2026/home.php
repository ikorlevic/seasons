<?php
/**
 * Editorial homepage, inspired by the Seasonal Garden Theme prototype.
 * Keep the existing seasonal hero, highlights and garden-care templates.
 */
get_header();
?>
<main id="main-content" class="home seasons-home">
    <?php get_template_part('templates-part/season-highlights'); ?>
    <?php // The legacy garden-care sidebar is intentionally not rendered here; it created an empty block before From My Garden. ?>

    <?php
    /*
     * From My Garden uses the current season category directly.
     * Holiday themes retain their existing activation logic and fall back
     * to the corresponding gardening season for article selection.
     */
    $active_garden_season = current_season();
    if ($active_garden_season === 'halloween') {
        $active_garden_season = 'autumn';
    } elseif (in_array($active_garden_season, array('yule', 'ny', 'valentines'), true)) {
        $active_garden_season = 'winter';
    }
    $season_category = get_category_by_slug($active_garden_season);
    $garden_query_args = $season_category
        ? array(
            'cat' => (int) $season_category->term_id,
            'posts_per_page' => 3,
            'ignore_sticky_posts' => true,
        )
        : null;
    $garden_posts = $garden_query_args ? new WP_Query($garden_query_args) : null;
    if ($garden_posts && $garden_posts->have_posts()) :
    ?>
    <section class="seasons-home-section seasons-home-from-garden" aria-labelledby="seasons-from-garden-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading">
                <h2 id="seasons-from-garden-title"><?php esc_html_e('From My Garden', 'seasons'); ?></h2>
                <p><?php echo esc_html(sprintf(__('Stories and discoveries from the %s garden.', 'seasons'), $active_garden_season)); ?></p>
            </div>
            <div class="seasons-home-grid">
                <?php while ($garden_posts->have_posts()) : $garden_posts->the_post(); ?>
                    <article <?php post_class('seasons-home-card'); ?>>
                        <a class="seasons-home-card-link" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="seasons-home-card-image"><?php the_post_thumbnail('medium_large', array('loading' => 'lazy')); ?></div>
                            <?php endif; ?>
                            <div class="seasons-home-card-content">
                                <span class="seasons-home-card-meta"><?php echo esc_html(get_the_date()); ?></span>
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
                                <span class="seasons-home-readmore"><?php esc_html_e('Read the story', 'seasons'); ?> &rarr;</span>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php endif; wp_reset_postdata(); ?>

    <?php
    // Use real WordPress posts; no prototype-only articles or placeholder links.
    $sections = array(
        array('title' => __('In the Garden Now', 'seasons'), 'intro' => __("What we're growing, doing and discovering this season.", 'seasons'), 'slugs' => array('garden', 'gardening'), 'class' => 'garden'),
        array('title' => __('From the Recipe Book', 'seasons'), 'intro' => __('Recipes for everyday cooking and seasonal celebrations.', 'seasons'), 'slugs' => array('recipes', 'recipe-book'), 'class' => 'recipes'),
        array('title' => __('At Home This Season', 'seasons'), 'intro' => __('Ideas for making the most of the season at home.', 'seasons'), 'slugs' => array('at-home', 'home'), 'class' => 'at-home'),
    );

    foreach ($sections as $section) :
        $category = null;
        foreach ($section['slugs'] as $slug) {
            $candidate = get_category_by_slug($slug);
            if ($candidate) {
                $category = $candidate;
                break;
            }
        }
        // Never invent category associations: hide sections until a matching category exists.
        if (!$category) {
            continue;
        }
        $posts = new WP_Query(array(
            'cat' => (int) $category->term_id,
            'posts_per_page' => 3,
            'ignore_sticky_posts' => true,
        ));
        if (!$posts->have_posts()) {
            wp_reset_postdata();
            continue;
        }
    ?>
    <section class="seasons-home-section seasons-home-<?php echo esc_attr($section['class']); ?>" aria-label="<?php echo esc_attr($section['title']); ?>">
        <div class="seasons-home-container">
            <div class="seasons-home-heading">
                <h2><?php echo esc_html($section['title']); ?></h2>
                <p><?php echo esc_html($section['intro']); ?></p>
            </div>
            <div class="seasons-home-grid">
                <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                    <article <?php post_class('seasons-home-card'); ?>>
                        <a class="seasons-home-card-link" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="seasons-home-card-image"><?php the_post_thumbnail('medium_large', array('loading' => 'lazy')); ?></div>
                            <?php endif; ?>
                            <div class="seasons-home-card-content">
                                <span class="seasons-home-card-meta"><?php echo esc_html(get_the_date()); ?></span>
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
                                <span class="seasons-home-readmore"><?php esc_html_e('Read the story', 'seasons'); ?> &rarr;</span>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
            <a class="seasons-home-more" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                <?php echo esc_html(sprintf(__('Explore %s', 'seasons'), $category->name)); ?> &rarr;
            </a>
        </div>
    </section>
    <?php wp_reset_postdata(); endforeach; ?>

    <section class="seasons-home-section seasons-home-latest" aria-labelledby="seasons-latest-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading">
                <h2 id="seasons-latest-title"><?php esc_html_e('From Seasons Past & Present', 'seasons'); ?></h2>
                <p><?php esc_html_e('More stories from the garden, kitchen and home.', 'seasons'); ?></p>
            </div>
            <div class="seasons-home-grid">
                <?php
                $latest = new WP_Query(array('posts_per_page' => 3, 'ignore_sticky_posts' => true));
                while ($latest->have_posts()) : $latest->the_post();
                ?>
                    <article <?php post_class('seasons-home-card'); ?>>
                        <a class="seasons-home-card-link" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="seasons-home-card-image"><?php the_post_thumbnail('medium_large', array('loading' => 'lazy')); ?></div>
                            <?php endif; ?>
                            <div class="seasons-home-card-content">
                                <span class="seasons-home-card-meta"><?php echo esc_html(get_the_date()); ?></span>
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
                                <span class="seasons-home-readmore"><?php esc_html_e('Read the story', 'seasons'); ?> &rarr;</span>
                            </div>
                        </a>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
