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
$season = seasons_content_season();
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
            <?php while ($notes->have_posts()) : $notes->the_post(); ?>
                    <?php get_template_part('templates-part/personal-note-card'); ?>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php wp_reset_postdata(); ?>
