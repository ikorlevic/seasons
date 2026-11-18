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
    $garden_category = get_category_by_slug('garden');
    // Only posts assigned to BOTH the active season and Garden belong here.
    $season_post = ($season_category && $garden_category) ? new WP_Query(array(
        'category__and' => array((int) $season_category->term_id, (int) $garden_category->term_id),
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
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
            <div class="seasons-home-grid seasons-garden-now-grid">
                <?php while ($season_post->have_posts()) : $season_post->the_post(); ?>
                    <article <?php post_class('seasons-home-card'); ?>>
                        <a class="seasons-home-card-link" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="seasons-home-card-image"><?php the_post_thumbnail('medium_large', array('loading' => 'lazy')); ?></div>
                            <?php endif; ?>
                            <div class="seasons-home-card-content">
                                <span class="seasons-home-card-meta"><?php echo esc_html(ucfirst($active_garden_season)); ?></span>
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
                                <span class="seasons-home-readmore"><?php esc_html_e('Read the story', 'seasons'); ?> &rarr;</span>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
            <a class="seasons-home-more" href="<?php echo esc_url(get_category_link($season_category->term_id)); ?>">
                <?php esc_html_e('Explore the season', 'seasons'); ?> &rarr;
            </a>
        </div>
    </section>
    <?php endif; wp_reset_postdata(); ?>

    <?php
    // Load up to six editable notes for the current gardening season.
    $garden_notes = new WP_Query(array(
        'post_type' => 'garden_note',
        'post_status' => 'publish',
        'posts_per_page' => 6,
        'meta_query' => array(array(
            'key' => '_seasons_note_season',
            'value' => $active_garden_season,
        )),
        'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'),
        'ignore_sticky_posts' => true,
    ));
    if ($garden_notes->have_posts()) :
    ?>
    <section class="seasons-home-section seasons-home-from-garden" aria-labelledby="seasons-from-garden-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading">
                <span class="seasons-home-eyebrow"><?php esc_html_e('Personal Notes', 'seasons'); ?></span>
                <h2 id="seasons-from-garden-title"><?php esc_html_e('From My Garden', 'seasons'); ?></h2>
                <p><?php esc_html_e("Things I've learned growing through the seasons.", 'seasons'); ?></p>
            </div>
            <div class="seasons-garden-notes-grid seasons-garden-notes-count-<?php echo esc_attr((string) $garden_notes->post_count); ?>">
                <?php while ($garden_notes->have_posts()) : $garden_notes->the_post();
                    $note_label = get_post_meta(get_the_ID(), '_seasons_note_label', true);
                    $note_tone = get_post_meta(get_the_ID(), '_seasons_note_tone', true);
                    if (!in_array($note_tone, array('green', 'teal', 'blue', 'orange'), true)) {
                        $note_tone = 'green';
                    }
                ?>
                    <article class="seasons-garden-note">
                        <?php if ($note_label) : ?>
                            <span class="seasons-garden-note-label seasons-garden-note-<?php echo esc_attr($note_tone); ?>"><?php echo esc_html($note_label); ?></span>
                        <?php endif; ?>
                        <h3><?php the_title(); ?></h3>
                        <div class="seasons-garden-note-body"><?php echo wpautop(esc_html(wp_strip_all_tags(get_the_content()))); ?></div>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php endif; wp_reset_postdata(); ?>

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
