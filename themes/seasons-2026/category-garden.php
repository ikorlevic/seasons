<?php
/**
 * Garden category landing page. Uses the homepage's garden components and
 * the native category archive query so pagination and category membership work.
 */
get_header();
?>
<main id="main-content" class="home seasons-home seasons-garden-archive">
    <?php get_template_part('templates-part/season-highlights'); ?>
    <?php
    $active_garden_season = current_season();
    if ($active_garden_season === 'halloween') {
        $active_garden_season = 'autumn';
    } elseif (in_array($active_garden_season, array('yule', 'ny', 'valentines'), true)) {
        $active_garden_season = 'winter';
    }
    ?>
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
                <nav class="seasons-garden-pagination" aria-label="<?php esc_attr_e('Garden posts pagination', 'seasons'); ?>">
                    <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => __('Previous', 'seasons'), 'next_text' => __('Next', 'seasons'))); ?>
                </nav>
            <?php else : ?>
                <p><?php esc_html_e('No garden posts found yet.', 'seasons'); ?></p>
            <?php endif; ?>
        </div>
    </section>
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
    // The four gardening seasons only; holiday skins are intentionally excluded.
    $explore_seasons = array(
        'spring' => array('title' => __('Spring', 'seasons'), 'description' => __('Awakening & Renewal', 'seasons'), 'icon' => 'local_florist'),
        'summer' => array('title' => __('Summer', 'seasons'), 'description' => __('Abundance & Vitality', 'seasons'), 'icon' => 'sunny'),
        'autumn' => array('title' => __('Fall', 'seasons'), 'description' => __('Harvest & Transition', 'seasons'), 'icon' => 'eco'),
        'winter' => array('title' => __('Winter', 'seasons'), 'description' => __('Rest & Planning', 'seasons'), 'icon' => 'ac_unit'),
    );    ?>
    <section class="seasons-home-section seasons-home-explore" aria-labelledby="seasons-explore-title">
        <div class="seasons-home-container">
            <div class="seasons-home-heading text-center">
                <h2 id="seasons-explore-title"><?php esc_html_e('Explore All Seasons', 'seasons'); ?></h2>
                <p><?php esc_html_e('Discover gardening tips and inspiration for every time of year', 'seasons'); ?></p>
            </div>
            <div class="seasons-explore-grid">
                <?php foreach ($explore_seasons as $slug => $details) :
                    $season_term = get_category_by_slug($slug);
                    if (!$season_term) {
                        continue;
                    }
                ?>
                    <a class="seasons-explore-card seasons-explore-<?php echo esc_attr($slug); ?> <?php echo esc_attr($slug); ?>" href="<?php echo esc_url(get_category_link($season_term->term_id)); ?>">
                        <span class="seasons-explore-card-icon material-symbols-outlined" aria-hidden="true"><?php echo esc_html($details['icon']); ?></span>
                        <span class="seasons-explore-card-label"><?php echo esc_html($details['title']); ?></span>
                        <span class="seasons-explore-card-description"><?php echo esc_html($details['description']); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
