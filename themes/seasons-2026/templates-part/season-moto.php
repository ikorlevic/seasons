<?php
  $actualSeason = current_season();
  $season = $actualSeason;

  if(is_home()) {
      $season = $actualSeason;
  } else {
        $obj = get_queried_object();
        $season = get_selected_season($obj);
  }
?>
<div class="moto text-center d-flex jcc align-center flex-column <?php echo $season ?>" >
    <h1 class="bolder title"><?php echo $season ?></h1>
    <h2 class="title italic"><?php echo season_moto($season) ?></h3>
    <p><?php echo season_desc($season) ?>
    </p>
<div class="season-selector">
    <?php if (has_nav_menu('seasons')) : ?>
        <details class="season-selector-details">
            <summary class="pill season-selector-trigger"><?php echo esc_html(ucfirst($season)); ?></summary>
            <?php wp_nav_menu(array(
                'theme_location' => 'seasons',
                'container' => 'nav',
                'container_class' => 'pill-menu season-selector-menu',
                'container_aria_label' => __('Choose a season', 'seasons'),
                'fallback_cb' => false,
            )); ?>
        </details>
    <?php else : ?>
        <span class="pill season-selector-trigger"><?php echo esc_html(ucfirst($season)); ?></span>
    <?php endif; ?>
</div>
</div>
