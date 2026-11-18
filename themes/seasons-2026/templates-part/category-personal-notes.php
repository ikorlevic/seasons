<?php
/**
 * Personal seasonal notes. Pass 'area' (garden, kitchen, home) via get_template_part().
 * Only call from the main category template, never subcategory archives.
 */
$area = isset($args['area']) ? $args['area'] : '';
$config = array(
    'garden' => array('type' => 'garden_note', 'title' => 'From My Garden', 'description' => "Things I've learned growing through the seasons."),
    'kitchen' => array('type' => 'kitchen_note', 'title' => 'From My Kitchen', 'description' => 'Little discoveries and comforts from my seasonal kitchen.'),
    'home' => array('type' => 'home_note', 'title' => 'From My Home', 'description' => 'Small ways to make home feel special through the seasons.'),
);
if (!isset($config[$area]) || !post_type_exists($config[$area]['type'])) {
    return;
}
$season = current_season();
if ($season === 'halloween') {
    $season = 'autumn';
} elseif (in_array($season, array('yule', 'ny', 'valentines'), true)) {
    $season = 'winter';
}
$notes = new WP_Query(array(
    'post_type' => $config[$area]['type'],
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'meta_query' => array(array('key' => '_seasons_note_season', 'value' => $season)),
    'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'),
    'ignore_sticky_posts' => true,
));
if (!$notes->have_posts()) {
    wp_reset_postdata();
    return;
}
?>
<section class="seasons-home-section seasons-home-from-garden seasons-home-personal-notes" aria-labelledby="seasons-<?php echo esc_attr($area); ?>-notes-title">
    <div class="seasons-home-container">
        <div class="seasons-home-heading">
            <span class="seasons-home-eyebrow"><?php esc_html_e('Personal Notes', 'seasons'); ?></span>
            <h2 id="seasons-<?php echo esc_attr($area); ?>-notes-title"><?php echo esc_html($config[$area]['title']); ?></h2>
            <p><?php echo esc_html($config[$area]['description']); ?></p>
        </div>
        <div class="seasons-garden-notes-grid seasons-garden-notes-count-<?php echo esc_attr((string) $notes->post_count); ?>">
            <?php while ($notes->have_posts()) : $notes->the_post();
                $label = get_post_meta(get_the_ID(), '_seasons_note_label', true);
                $tone = get_post_meta(get_the_ID(), '_seasons_note_tone', true);
                if (!in_array($tone, array('green', 'teal', 'blue', 'orange'), true)) {
                    $tone = 'green';
                }
            ?>
                <article class="seasons-garden-note">
                    <?php if ($label) : ?>
                        <span class="seasons-garden-note-label seasons-garden-note-<?php echo esc_attr($tone); ?>"><?php echo esc_html($label); ?></span>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                    <div class="seasons-garden-note-body"><?php echo wpautop(esc_html(wp_strip_all_tags(get_the_content()))); ?></div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php wp_reset_postdata(); ?>
