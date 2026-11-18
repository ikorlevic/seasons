<?php
/**
 * Editorial homepage, inspired by the Seasonal Garden Theme prototype.
 * Keep the existing seasonal hero, highlights and garden-care templates.
 */
get_header();
?>
<main id="main-content" class="home seasons-home">
    <?php get_template_part('templates-part/season-highlights'); ?>
    <?php
    // Holiday skins use their gardening season without changing activation dates.
    $active_garden_season = current_season();
    if ($active_garden_season === 'halloween') {
        $active_garden_season = 'autumn';
    } elseif (in_array($active_garden_season, array('yule', 'ny', 'valentines'), true)) {
        $active_garden_season = 'winter';
    }
    $season_category = get_category_by_slug($active_garden_season);
    $season_post = $season_category ? new WP_Query(array(
        'cat' => (int) $season_category->term_id,
        'posts_per_page' => 1,
        'ignore_sticky_posts' => true,
    )) : null;
    if ($season_post && $season_post->have_posts()) :
    ?>
    <section class="seasons-home-section seasons-home-garden-now" aria-labelledby="seasons-garden-now-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading">
                <span class="seasons-home-eyebrow"><?php esc_html_e('The Garden', 'seasons'); ?></span>
                <h2 id="seasons-garden-now-title"><?php esc_html_e('In the Garden Now', 'seasons'); ?></h2>
            </div>
            <?php while ($season_post->have_posts()) : $season_post->the_post(); ?>
                <article <?php post_class('seasons-home-season-feature'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <a class="seasons-home-season-image" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large', array('loading' => 'lazy')); ?></a>
                    <?php endif; ?>
                    <div class="seasons-home-season-content">
                        <span class="seasons-home-card-meta"><?php echo esc_html($active_garden_season); ?></span>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 36)); ?></p>
                        <a class="seasons-home-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read the story', 'seasons'); ?> &rarr;</a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endif; wp_reset_postdata(); ?>

    <?php
    // Personal seasonal notes; these are editorial tips, not a post feed.
    $garden_notes = array(
        'autumn' => array(
            array('label' => 'What I Learned', 'title' => 'Tulip Bulbs', 'text' => 'I plant tulip bulbs in November rather than September. Later planting means much less risk from tulip fire, and they flower just as beautifully.', 'tone' => 'green'),
            array('label' => 'From My Garden', 'title' => 'Autumn Leaves', 'text' => 'I stopped raking leaves off the borders entirely. The worms appreciate the cover and they break down completely by spring — free mulch.', 'tone' => 'teal'),
            array('label' => 'Good to Know', 'title' => 'Storing Dahlias', 'text' => 'Dahlias stored in dry compost kept far better last winter than the ones I stored bare. The compost stops them shrivelling through the cold months.', 'tone' => 'blue'),
            array('label' => "I'd Do This Differently", 'title' => 'Winter Structure', 'text' => 'I used to cut back everything in autumn. Now I leave seed heads and grasses until late February. Better for wildlife, and much more interesting through winter.', 'tone' => 'orange'),
        ),
    );
    // Other seasons can supply their own notes without displaying autumn advice out of season.
    $garden_notes = apply_filters('seasons_garden_notes', $garden_notes, $active_garden_season);
    $current_garden_notes = isset($garden_notes[$active_garden_season]) ? $garden_notes[$active_garden_season] : array();
    if ($current_garden_notes) :
    ?>
    <section class="seasons-home-section seasons-home-from-garden" aria-labelledby="seasons-from-garden-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading">
                <span class="seasons-home-eyebrow"><?php esc_html_e('Personal Notes', 'seasons'); ?></span>
                <h2 id="seasons-from-garden-title"><?php esc_html_e('From My Garden', 'seasons'); ?></h2>
                <p><?php esc_html_e("Things I've learned growing through the seasons.", 'seasons'); ?></p>
            </div>
            <div class="seasons-garden-notes-grid">
                <?php foreach ($current_garden_notes as $note) : ?>
                    <article class="seasons-garden-note">
                        <span class="seasons-garden-note-label seasons-garden-note-<?php echo esc_attr($note['tone']); ?>"><?php echo esc_html($note['label']); ?></span>
                        <h3><?php echo esc_html($note['title']); ?></h3>
                        <p><?php echo esc_html($note['text']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // Use real WordPress posts; no prototype-only articles or placeholder links.
    $sections = array(
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
