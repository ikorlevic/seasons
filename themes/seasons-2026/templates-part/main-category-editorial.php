<?php
/**
 * Editorial main category landing page for Recipe Book and At Home.
 * Included only by the explicit top-level category templates.
 */
$area = isset($seasons_category_area) ? $seasons_category_area : '';
if (!in_array($area, array('kitchen', 'home'), true)) {
    return;
}
$category_title = $area === 'kitchen' ? __('Recipe Book', 'seasons') : __('At Home', 'seasons');
get_header();
?>
<main id="main-content" class="home seasons-home seasons-garden-archive seasons-category-editorial seasons-category-<?php echo esc_attr($area); ?>">
    <?php get_template_part('templates-part/category-seasonal-tips', null, array('area' => $area)); ?>

    <?php get_template_part('templates-part/category-personal-notes', null, array('area' => $area)); ?>

    <?php if ($area === 'kitchen') :
        // Feature a real recipe post from this category, prioritizing soup and the active season.
        $season = seasons_content_season();
        $recipe_term = get_queried_object();
        $season_term = get_term_by('slug', $season, 'content_season');
        $soup_term = seasons_first_category(array('soup', 'soups'));
        $base = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'ignore_sticky_posts' => true,
            'orderby' => 'date',
            'category__in' => array((int) $recipe_term->term_id),
        );
        $candidates = array();
        if ($season_term && !is_wp_error($season_term)) {
            $seasonal = $base;
            $seasonal['tax_query'] = array(array(
                'taxonomy' => 'content_season',
                'field' => 'term_id',
                'terms' => array((int) $season_term->term_id),
            ));
            if ($soup_term) {
                $seasonal_soup = $seasonal;
                $seasonal_soup['category__and'] = array(
                    (int) $recipe_term->term_id,
                    (int) $soup_term->term_id,
                );
                unset($seasonal_soup['category__in']);
                $candidates[] = $seasonal_soup;
            }
            $candidates[] = $seasonal;
        }
        // Preserve the category landing page's existing evergreen fallback.
        $candidates[] = $base;
        $featured = seasons_first_matching_query($candidates);
        if ($featured) :
    ?>
    <?php get_template_part('templates-part/featured-seasonal-recipe', null, array('query' => $featured, 'season' => $season)); ?>
    <?php endif; wp_reset_postdata(); endif; ?>


    <section class="seasons-home-section seasons-home-garden-now" aria-labelledby="seasons-category-articles-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading text-center">
                <span class="seasons-home-eyebrow"><?php echo esc_html($category_title); ?></span>
                <h1 id="seasons-category-articles-title"><?php single_cat_title(); ?></h1>
                <?php if (category_description()) : ?>
                    <div class="seasons-garden-archive-description"><?php echo wp_kses_post(category_description()); ?></div>
                <?php endif; ?>
            </div>
            <?php if (have_posts()) : ?>
                <div class="seasons-home-grid seasons-garden-now-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('templates-part/editorial-post-card', null, array('readmore' => ($area === 'kitchen' ? __('Read the recipe', 'seasons') : __('Read the story', 'seasons')))); ?>
                    <?php endwhile; ?>
                </div>
                <?php get_template_part('templates-part/editorial-pagination', null, array('label' => __('Category posts pagination', 'seasons'))); ?>
            <?php else : ?>
                <p><?php esc_html_e('No posts found yet.', 'seasons'); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <?php get_template_part('templates-part/explore-seasons', null, array('description' => __('Discover seasonal inspiration for every time of year', 'seasons'))); ?>
</main>
<?php get_footer(); ?>
