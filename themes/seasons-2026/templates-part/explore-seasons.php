<?php
/**
 * Shared Explore All Seasons section.
 * Links point to the cross-category content_season archives.
 */
$description = isset($args['description'])
    ? $args['description']
    : __('Discover gardening tips and inspiration for every time of year', 'seasons');
$explore_seasons = array(
    'spring' => array('title' => __('Spring', 'seasons'), 'description' => __('Awakening & Renewal', 'seasons'), 'icon' => 'local_florist'),
    'summer' => array('title' => __('Summer', 'seasons'), 'description' => __('Abundance & Vitality', 'seasons'), 'icon' => 'sunny'),
    'autumn' => array('title' => __('Fall', 'seasons'), 'description' => __('Harvest & Transition', 'seasons'), 'icon' => 'eco'),
    'winter' => array('title' => __('Winter', 'seasons'), 'description' => __('Rest & Planning', 'seasons'), 'icon' => 'ac_unit'),
);
?>
<section class="seasons-home-section seasons-home-explore" aria-labelledby="seasons-explore-title">
    <div class="seasons-home-container">
        <div class="seasons-home-heading text-center">
            <h2 id="seasons-explore-title"><?php esc_html_e('Explore All Seasons', 'seasons'); ?></h2>
            <p><?php echo esc_html($description); ?></p>
        </div>
        <div class="seasons-explore-grid">
            <?php foreach ($explore_seasons as $slug => $details) :
                $season_term = get_term_by('slug', $slug, 'content_season');
                if (!$season_term || is_wp_error($season_term)) { continue; }
                $season_url = get_term_link($season_term);
                if (is_wp_error($season_url)) { continue; }
            ?>
                <a class="seasons-explore-card seasons-explore-<?php echo esc_attr($slug); ?> <?php echo esc_attr($slug); ?>" href="<?php echo esc_url($season_url); ?>">
                    <span class="seasons-explore-card-icon material-symbols-outlined" aria-hidden="true"><?php echo esc_html($details['icon']); ?></span>
                    <span class="seasons-explore-card-label"><?php echo esc_html($details['title']); ?></span>
                    <span class="seasons-explore-card-description"><?php echo esc_html($details['description']); ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
