<?php
/**
 * Seasonal highlights, using the theme's existing season_high() data.
 */
$season = current_season();
if (!is_home() && !is_front_page()) {
    $queried = get_queried_object();
    $season = get_selected_season($queried);
}
$highlights = season_high($season);
if (!empty($highlights)) :
?>
<section class="highlights seasons-highlights seasons-home-section" aria-labelledby="seasons-highlights-title">
    <div class="seasons-home-container">
        <div class="seasons-home-heading">
            <h2 id="seasons-highlights-title"><?php esc_html_e("What's Happening Now", 'seasons'); ?></h2>
            <p><?php esc_html_e('A little inspiration for the season ahead.', 'seasons'); ?></p>
        </div>
        <div class="seasons-highlights-grid">
            <?php foreach ($highlights as $highlight) : ?>
                <article class="seasons-highlight">
                    <?php if (!empty($highlight['icon'])) : ?>
                        <span class="seasons-highlight-icon material-symbols-outlined" aria-hidden="true"><?php echo esc_html($highlight['icon']); ?></span>
                    <?php endif; ?>
                    <h3><?php echo esc_html(isset($highlight['title']) ? $highlight['title'] : ''); ?></h3>
                    <?php if (!empty($highlight['description'])) : ?>
                        <p><?php echo wp_kses_post($highlight['description']); ?></p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
