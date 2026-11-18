<?php
/** Four seasonal gardening tasks; separate from the photographic article cards. */
$active_season = current_season();
$garden_season = $active_season === 'halloween' ? 'autumn' : (in_array($active_season, array('yule', 'ny', 'valentines'), true) ? 'winter' : $active_season);
$seasonal_tasks = array(
    'spring' => array(
        array('icon' => 'potted_plant', 'title' => 'Start Planting', 'description' => 'Sow hardy seeds and prepare beds for new growth.'),
        array('icon' => 'compost', 'title' => 'Feed the Soil', 'description' => 'Add compost to give your garden a healthy start.'),
        array('icon' => 'water_drop', 'title' => 'Watch the Weather', 'description' => 'Protect tender seedlings from late cold snaps.'),
        array('icon' => 'menu_book', 'title' => 'Plan the Season', 'description' => 'Make room for your favorite flowers and vegetables.'),
    ),
    'summer' => array(
        array('icon' => 'water_drop', 'title' => 'Water Deeply', 'description' => 'Water early and keep roots cool.'),
        array('icon' => 'local_florist', 'title' => 'Enjoy the Blooms', 'description' => 'Deadhead flowers to encourage another flush.'),
        array('icon' => 'nutrition', 'title' => 'Harvest Often', 'description' => 'Pick ripe produce regularly.'),
        array('icon' => 'menu_book', 'title' => 'Make a Note', 'description' => 'Remember what thrives in your summer garden.'),
    ),
    'autumn' => array(
        array('icon' => 'inventory_2', 'title' => 'Plant Spring Bulbs', 'description' => 'Tulips, alliums and narcissus go in now for a spring display.'),
        array('icon' => 'eco', 'title' => 'Compost the Leaves', 'description' => 'Don\'t rake borders clean — leave some cover for wildlife and worms.'),
        array('icon' => 'ac_unit', 'title' => 'Protect What Matters', 'description' => 'Lift dahlias after first frost. Mulch tender plants before hard frosts arrive.'),
        array('icon' => 'menu_book', 'title' => 'Plan Next Year', 'description' => 'Note what worked and what failed while it is still fresh in your memory.'),
    ),
    'winter' => array(
        array('icon' => 'ac_unit', 'title' => 'Protect Tender Plants', 'description' => 'Check fleece, mulch and shelter after cold weather.'),
        array('icon' => 'compost', 'title' => 'Care for the Soil', 'description' => 'Leave winter cover in place to protect the ground.'),
        array('icon' => 'potted_plant', 'title' => 'Plan Spring Planting', 'description' => 'Choose seeds and bulbs for the growing season ahead.'),
        array('icon' => 'menu_book', 'title' => 'Reflect and Plan', 'description' => 'Look back at the garden and make notes for next year.'),
    ),
);
$tasks = isset($seasonal_tasks[$garden_season]) ? $seasonal_tasks[$garden_season] : $seasonal_tasks['spring'];
?>
<section class="seasons-now text-center" aria-labelledby="seasons-now-title">
    <div class="seasons-now-inner">
        <header class="seasons-now-heading">
            <span class="seasons-now-eyebrow"><?php esc_html_e('Right Now', 'seasons'); ?></span>
            <h2 id="seasons-now-title"><?php esc_html_e("What's Happening Now", 'seasons'); ?></h2>
            <p><?php esc_html_e('What is worth doing in the garden right now.', 'seasons'); ?></p>
        </header>
        <div class="seasons-now-grid">
            <?php foreach ($tasks as $task) : ?>
                <div class="seasons-now-item text-center">
                    <span class="seasons-now-icon material-symbols-outlined" aria-hidden="true"><?php echo esc_html($task['icon']); ?></span>
                    <h3><?php echo esc_html($task['title']); ?></h3>
                    <p><?php echo esc_html($task['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
