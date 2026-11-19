<?php
/**
 * Garden category landing page. Uses the homepage's garden components and
 * the native category archive query so pagination and category membership work.
 */
get_header();
?>
<main id="main-content" class="home seasons-home seasons-garden-archive">
    <?php
    $active_garden_season = seasons_content_season();
    ?>
    <?php get_template_part('templates-part/category-seasonal-tips', null, array('area' => 'garden')); ?>
    <?php get_template_part('templates-part/category-personal-notes', null, array('area' => 'garden')); ?>

    <section class="seasons-home-section seasons-home-garden-now" aria-labelledby="garden-archive-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading text-center">
                <span class="seasons-home-eyebrow"><?php esc_html_e('The Garden', 'seasons'); ?></span>
                <h1 id="garden-archive-title"><?php single_cat_title(); ?></h1>
                <?php if (category_description()) : ?>
                    <div class="seasons-garden-archive-description"><?php echo wp_kses_post(category_description()); ?></div>
                <?php endif; ?>
            </div>
            <?php if (have_posts()) : ?>
                <div class="seasons-home-grid seasons-garden-now-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('templates-part/editorial-post-card', null, array()); ?>
                    <?php endwhile; ?>
                </div>
                <?php get_template_part('templates-part/editorial-pagination', null, array('label' => __('Garden posts pagination', 'seasons'))); ?>
            <?php else : ?>
                <p><?php esc_html_e('No garden posts found yet.', 'seasons'); ?></p>
            <?php endif; ?>
        </div>
    </section>
    <?php get_template_part('templates-part/explore-seasons'); ?>
</main>
<?php get_footer(); ?>
