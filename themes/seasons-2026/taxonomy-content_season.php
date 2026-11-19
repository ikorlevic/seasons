<?php
/**
 * Seasonal archive spanning Garden, Recipe Book, At Home and DIY.
 * Unlike the legacy season categories, this taxonomy is independent of topic.
 */
get_header();
$seasons_term = get_queried_object();
$seasons_title = $seasons_term instanceof WP_Term ? $seasons_term->name : __('Season', 'seasons');
$seasons_description = term_description();
?>
<main id="main-content" class="home seasons-home seasons-category-editorial seasons-season-archive">
    <section class="seasons-home-section seasons-season-archive-intro" aria-labelledby="seasons-season-archive-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading text-center">
                <span class="seasons-home-eyebrow"><?php esc_html_e('Explore the Seasons', 'seasons'); ?></span>
                <h1 id="seasons-season-archive-title"><?php echo esc_html($seasons_title); ?></h1>
                <?php if ($seasons_description) : ?>
                    <div class="seasons-season-archive-description"><?php echo wp_kses_post($seasons_description); ?></div>
                <?php else : ?>
                    <p><?php echo esc_html(sprintf(__('Ideas and inspiration for %s across the garden, kitchen, home and DIY.', 'seasons'), $seasons_title)); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
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
                <nav class="seasons-garden-pagination" aria-label="<?php esc_attr_e('Seasonal articles pagination', 'seasons'); ?>">
                    <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => __('Previous', 'seasons'), 'next_text' => __('Next', 'seasons'))); ?>
                </nav>
            <?php else : ?>
                <p class="text-center"><?php esc_html_e('Seasonal stories are coming soon.', 'seasons'); ?></p>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
