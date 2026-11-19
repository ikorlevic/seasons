<?php
/**
 * Seasonal archive spanning Garden, Recipe Book, At Home and DIY.
 * Unlike the legacy season categories, this taxonomy is independent of topic.
 */
get_header();
$seasons_term = get_queried_object();
$archive_season = $seasons_term instanceof WP_Term ? $seasons_term->slug : seasons_content_season();
?>
<main id="main-content" class="home seasons-home seasons-category-editorial seasons-season-archive">
    <?php get_template_part('templates-part/category-seasonal-tips', null, array('area' => 'garden', 'season' => $archive_season)); ?>
    <section class="seasons-home-section seasons-home-garden-now" aria-labelledby="seasons-season-stories-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading text-center">
                <span class="seasons-home-eyebrow"><?php esc_html_e('Seasonal Inspiration', 'seasons'); ?></span>
                <h2 id="seasons-season-stories-title"><?php esc_html_e('Stories & Projects', 'seasons'); ?></h2>
            </div>
            <?php if (have_posts()) : ?>
                <div class="seasons-home-grid seasons-garden-now-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('templates-part/editorial-post-card', null, array('readmore' => __('Read more', 'seasons'))); ?>
                    <?php endwhile; ?>
                </div>
                <?php get_template_part('templates-part/editorial-pagination', null, array('label' => __('Seasonal articles pagination', 'seasons'))); ?>
            <?php else : ?>
                <p class="text-center"><?php esc_html_e('Seasonal stories are coming soon.', 'seasons'); ?></p>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
