<?php
/**
 * Shared editorial featured recipe for the homepage and Recipe Book category.
 * Args: query (WP_Query), season (normalized season slug).
 */
$recipe_query = isset($args['query']) ? $args['query'] : null;
$recipe_season = isset($args['season']) ? $args['season'] : '';
if (!($recipe_query instanceof WP_Query) || !$recipe_query->have_posts()) {
    return;
}
?>
<section class="seasons-home-section seasons-home-garden-kitchen" aria-labelledby="seasons-garden-kitchen-title">
    <div class="seasons-home-container">
        <div class="seasons-home-heading text-center">
            <span class="seasons-home-eyebrow"><?php esc_html_e('Seasonal Recipe', 'seasons'); ?></span>
            <h2 id="seasons-garden-kitchen-title"><?php esc_html_e('From Garden to Kitchen', 'seasons'); ?></h2>
        </div>
        <?php while ($recipe_query->have_posts()) : $recipe_query->the_post(); ?>
            <article <?php post_class('seasons-featured-recipe'); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <a class="seasons-featured-recipe-image" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                        <?php the_post_thumbnail('large', array('loading' => 'lazy')); ?>
                    </a>
                <?php endif; ?>
                <div class="seasons-featured-recipe-content">
                    <span class="seasons-home-eyebrow"><?php echo esc_html(ucfirst($recipe_season)); ?> <?php esc_html_e('Recipe', 'seasons'); ?></span>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 36)); ?></p>
                    <a class="seasons-home-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e('Get the recipe', 'seasons'); ?> &rarr;</a>
                    <?php if ($recipe_season === 'spring' && get_post_field('post_name', get_the_ID()) === 'parchment-baked-carrot-soup') : ?>
                        <p><a href="<?php echo esc_url(home_url('/menus/all-about-carrot-easter-menu/')); ?>"><?php esc_html_e('Explore the full All About Carrot menu', 'seasons'); ?> &rarr;</a></p>
                    <?php endif; ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</section>
