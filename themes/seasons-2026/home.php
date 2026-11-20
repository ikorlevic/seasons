<?php
/**
 * Editorial homepage, inspired by the Seasonal Garden Theme prototype.
 * Keep the existing seasonal hero and seasonal highlights; garden notes are plugin-managed.
 */
get_header();
?>
<main id="main-content" class="home seasons-home">
    <?php get_template_part('templates-part/season-highlights'); ?>
    <?php
    // Holiday skins use their gardening season without changing activation dates.
    $active_garden_season = seasons_content_season();
    $season_term = get_term_by('slug', $active_garden_season, 'content_season');
    $garden_category = get_category_by_slug('garden');
    $season_archive_url = $season_term ? get_term_link($season_term) : null;
    if (is_wp_error($season_archive_url)) {
        $season_archive_url = null;
    }
    // Reuse the same season-specific Personal Notes shown on the three category pages.
    // Choose one random published note per area on each uncached page request.
    $seasonal_notes = array();
    $note_areas = array(
        array('type' => 'garden_note', 'label' => __('In the Garden', 'seasons')),
        array('type' => 'kitchen_note', 'label' => __('Recipe Book', 'seasons')),
        array('type' => 'home_note', 'label' => __('At Home', 'seasons')),
    );
    foreach ($note_areas as $area) {
        if (!post_type_exists($area['type'])) {
            continue;
        }
        $notes = get_posts(array(
            'post_type' => $area['type'],
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'orderby' => 'rand',
            'meta_query' => array(array(
                'key' => '_seasons_note_season',
                'value' => $active_garden_season,
            )),
            'suppress_filters' => false,
        ));
        if ($notes) {
            $seasonal_notes[] = array('post' => $notes[0], 'label' => $area['label']);
        }
    }
    if ($seasonal_notes) :
    ?>
    <section class="seasons-home-section seasons-home-from-garden seasons-home-this-season" aria-labelledby="seasons-this-season-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading">
                <span class="seasons-home-eyebrow"><?php esc_html_e('Personal Notes', 'seasons'); ?></span>
                <h2 id="seasons-this-season-title"><?php esc_html_e('This Season', 'seasons'); ?></h2>
                <p><?php esc_html_e('Little discoveries from the garden, kitchen and home.', 'seasons'); ?></p>
            </div>
            <div class="seasons-garden-notes-grid seasons-garden-notes-count-<?php echo esc_attr((string) count($seasonal_notes)); ?>">
                <?php
                global $post;
                foreach ($seasonal_notes as $note) :
                    $post = $note['post'];
                    setup_postdata($post);
                ?>
                    <div class="seasons-this-season-note">
                        <span class="seasons-this-season-area"><?php echo esc_html($note['label']); ?></span>
                        <?php get_template_part('templates-part/personal-note-card'); ?>
                    </div>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // Only Garden posts assigned to the active editorial season belong here.
    $season_post = ($season_term && $garden_category) ? new WP_Query(array(
        'cat' => (int) $garden_category->term_id,
        'tax_query' => array(array(
            'taxonomy' => 'content_season',
            'field' => 'term_id',
            'terms' => array((int) $season_term->term_id),
        )),
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
        'ignore_sticky_posts' => true,
    )) : null;
    if ($season_post && $season_post->have_posts()) :
    ?>
    <section class="seasons-home-section seasons-home-garden-now" aria-labelledby="seasons-garden-now-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading text-center">
                <span class="seasons-home-eyebrow"><?php esc_html_e('The Garden', 'seasons'); ?></span>
                <h2 id="seasons-garden-now-title"><?php esc_html_e('In the Garden Now', 'seasons'); ?></h2>
            </div>
            <div class="seasons-home-grid seasons-garden-now-grid">
                <?php while ($season_post->have_posts()) : $season_post->the_post(); ?>
                    <?php get_template_part('templates-part/editorial-post-card', null, array('meta' => ucfirst($active_garden_season))); ?>
                <?php endwhile; ?>
            </div>
            <?php if ($season_archive_url) : ?>
            <a class="seasons-home-more" href="<?php echo esc_url($season_archive_url); ?>">
                <?php esc_html_e('Explore the season', 'seasons'); ?> &rarr;
            </a>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; wp_reset_postdata(); ?>

    <?php
    // Feature an existing seasonal soup first, falling back to another seasonal recipe.
    // Both category assignments are required to avoid unrelated articles.
    $recipe_category = seasons_first_category(array('recipes', 'recipe-book'));
    $featured_recipe = null;
    if ($season_term && $recipe_category) {
        $featured_recipe_args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'cat' => (int) $recipe_category->term_id,
            'tax_query' => array(array(
                'taxonomy' => 'content_season',
                'field' => 'term_id',
                'terms' => array((int) $season_term->term_id),
            )),
            'posts_per_page' => 1,
            'ignore_sticky_posts' => true,
            'no_found_rows' => true,
        );
        $featured_recipe = seasons_first_matching_query(array(
            array_merge($featured_recipe_args, array('s' => 'soup')),
            $featured_recipe_args,
        ));
    }
    if ($featured_recipe && $featured_recipe->have_posts()) :
    ?>
    <?php get_template_part('templates-part/featured-seasonal-recipe', null, array('query' => $featured_recipe, 'season' => $active_garden_season)); ?>
    <?php endif; wp_reset_postdata(); ?>

    <?php
    // Use real WordPress posts; no prototype-only articles or placeholder links.
    $sections = array(
        array('title' => __('From the Recipe Book', 'seasons'), 'intro' => __('Recipes for everyday cooking and seasonal celebrations.', 'seasons'), 'slugs' => array('recipes', 'recipe-book'), 'class' => 'recipes'),
        array('title' => __('At Home This Season', 'seasons'), 'intro' => __('Ideas for making the most of the season at home.', 'seasons'), 'slugs' => array('at-home', 'home'), 'class' => 'at-home'),
    );

    foreach ($sections as $section) :
        $category = seasons_first_category($section['slugs']);
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
                    <?php get_template_part('templates-part/editorial-post-card', null, array()); ?>
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
                    <?php get_template_part('templates-part/editorial-post-card', null, array()); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php get_template_part('templates-part/explore-seasons'); ?>
</main>
<?php get_footer(); ?>
