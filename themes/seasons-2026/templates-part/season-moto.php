<?php
  $actualSeason = current_season();
  $season = $actualSeason;

  // Garden is a content category, not a seasonal skin.
  if (is_category(array('garden', 'recipes', 'home'))) {
      $season = $actualSeason;
  } elseif(is_home()) {
      $season = $actualSeason;
  } else {
        $obj = get_queried_object();
        $season = get_selected_season($obj);
  }
?>
<div class="moto text-center d-flex jcc align-center flex-column <?php echo esc_attr($season); ?>" >
    <h1 class="bolder title"><?php echo $season ?></h1>
    <h2 class="title italic"><?php echo season_moto($season) ?></h3>
    <p><?php echo season_desc($season) ?>
    </p>
<div class="weather">
    <?php echo pdsweather_display() ?>
    </div>
<div class="season-selector">
    <details class="season-selector-details">
        <summary class="pill season-selector-trigger"><?php echo esc_html(ucfirst($season)); ?></summary>
        <nav class="pill-menu season-selector-menu text-left" aria-label="<?php esc_attr_e('Choose a season', 'seasons'); ?>">
            <?php seasons_render_taxonomy_navigation(); ?>
        </nav>
    </details>
</div>
</div>
