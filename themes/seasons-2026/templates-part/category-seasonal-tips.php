<?php
/** Four editable highlights for a main category, not its subcategories. */
$area = isset($args['area']) ? $args['area'] : '';
$headings = array(
    'garden' => array("What's Happening Now", 'What is worth doing in the garden right now.'),
    'kitchen' => array('In the Kitchen Now', 'Seasonal ingredients, drinks, and simple cooking inspiration.'),
    'home' => array('At Home Now', 'Small seasonal ideas for a welcoming home.'),
);
if (!isset($headings[$area]) || !function_exists('sst_get_tips')) {
    return;
}
$season = current_season();
if ($season === 'halloween') {
    $season = 'autumn';
} elseif (in_array($season, array('yule', 'ny', 'valentines'), true)) {
    $season = 'winter';
}
$tips = sst_get_tips($area, $season);
if (!$tips->have_posts()) {
    wp_reset_postdata();
    return;
}
?>
<section class="seasons-now text-center" aria-labelledby="seasons-<?php echo esc_attr($area); ?>-now-title">
    <div class="seasons-now-inner">
        <header class="seasons-now-heading">
            <span class="seasons-now-eyebrow"><?php esc_html_e('Right Now', 'seasons'); ?></span>
            <h2 id="seasons-<?php echo esc_attr($area); ?>-now-title"><?php echo esc_html($headings[$area][0]); ?></h2>
            <p><?php echo esc_html($headings[$area][1]); ?></p>
        </header>
        <div class="seasons-now-grid">
            <?php while ($tips->have_posts()) : $tips->the_post();
                $icon = sanitize_text_field(get_post_meta(get_the_ID(), '_seasons_tip_icon', true));
                if (!$icon) { $icon = 'lightbulb'; }
            ?>
                <div class="seasons-now-item text-center">
                    <span class="seasons-now-icon material-symbols-outlined d-inline-flex align-center jcc" aria-hidden="true"><?php echo esc_html($icon); ?></span>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo esc_html(wp_strip_all_tags(get_the_content())); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php wp_reset_postdata(); ?>
