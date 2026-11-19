<?php
/**
 * DIY Projects: an evergreen editorial landing page for the top-level DIY category.
 * Child categories retain WordPress's standard category archive template.
 */
get_header();
$seasons_diy_category = get_queried_object();
$seasons_diy_children = get_categories(array(
    'parent' => (int) $seasons_diy_category->term_id,
    'hide_empty' => true,
    'orderby' => 'name',
));
?>
<main id="main-content" class="home seasons-home seasons-garden-archive seasons-category-editorial seasons-category-diy">
    <section class="seasons-diy-hero" aria-label="<?php esc_attr_e('Hands making a DIY project in a sunlit workshop', 'seasons'); ?>">
        <div class="seasons-diy-hero-inner">
            <h1 class="bolder title"><?php single_cat_title(); ?></h1>
            <h2 class="title italic"><?php esc_html_e('Made by Hand', 'seasons'); ?></h2>
            <p><?php esc_html_e('Creative projects for the home, garden, and everything in between.', 'seasons'); ?></p>
        </div>
    </section>
    <section class="seasons-home-section seasons-home-diy-intro" aria-labelledby="seasons-diy-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading text-center">
                <span class="seasons-home-eyebrow"><?php esc_html_e('Make Something', 'seasons'); ?></span>
                <h2 id="seasons-diy-title"><?php esc_html_e('Explore DIY Projects', 'seasons'); ?></h2>
                <?php if (category_description()) : ?>
                    <div class="seasons-garden-archive-description"><?php echo wp_kses_post(category_description()); ?></div>
                <?php else : ?>
                    <p><?php esc_html_e('Practical and creative projects for the garden, the home, and everything in between.', 'seasons'); ?></p>
                <?php endif; ?>
            </div>
            <?php if ($seasons_diy_children) : ?>
                <nav class="seasons-diy-topics" aria-label="<?php esc_attr_e('Explore DIY project types', 'seasons'); ?>">
                    <?php foreach ($seasons_diy_children as $seasons_diy_child) : ?>
                        <a class="seasons-diy-topic" href="<?php echo esc_url(get_category_link($seasons_diy_child->term_id)); ?>"><?php echo esc_html($seasons_diy_child->name); ?></a>
                    <?php endforeach; ?>
                </nav>
            <?php endif; ?>
        </div>
    </section>

    <section class="seasons-home-section seasons-home-garden-now" aria-labelledby="seasons-diy-projects-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading text-center">
                <span class="seasons-home-eyebrow"><?php esc_html_e('DIY Projects', 'seasons'); ?></span>
                <h2 id="seasons-diy-projects-title"><?php esc_html_e('Projects to Make', 'seasons'); ?></h2>
            </div>
            <?php if (have_posts()) : ?>
                <div class="seasons-home-grid seasons-garden-now-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('templates-part/editorial-post-card', null, array('readmore' => __('Explore the project', 'seasons'))); ?>
                    <?php endwhile; ?>
                </div>
                <?php get_template_part('templates-part/editorial-pagination', null, array('label' => __('DIY project pagination', 'seasons'))); ?>
            <?php else : ?>
                <p><?php esc_html_e('DIY projects are coming soon.', 'seasons'); ?></p>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
